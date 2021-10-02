## Using Emojis in Django Model Fields

Using [emojis][] in [Django][] model fields is really easy. If you're using [SQLite][] as a database, you've nothing additional to do. You can save emojis in `TextField` or `CharField` without any problem. If you're using a [MySQL][] database, this article is for you, you'll need some work to insure that every text field can use emojis. Finally, if you're using a [PostgreSQL][] database, I won't be able to help you! I still haven't switch to PostgreSQL (even if it is [Two Scoops of Django][]'s recommendation)... So this article is really about saving emojis in a Django app backed by MySQL.

### A Basic sample app

Let's say we have a very simple Django app to manage comments.

Our model will be a `Comment` class, with two fields: a text field and an author field. In Django world, this translates in a `models.py` file like this:

	from django.db import models

	class Comment(models.Model):
		text = models.TextField(max_length=2048, blank=True)
		author = models.CharField(max_length=128, blank=True)

We have also a view that will display a list of comments, in `views.py`:

	from django.views.generic import ListView
	from .models import Comment

	class CommentsView(ListView):
		model = Comment
		context_object_name = 'comments'

With the associated template in `templates/comments/comment_list.html`:

	<h1>Comments</h1>
	<ul>
	{% for comment in comments %}
		<li>
			<p>{{ comment.author }}</p>
			<p>{{ comment.text }}</p>
		</li>
	{% empty %}
		<li>No comments yet.</li>
	{% endfor %}
	</ul>

The `admin.py` to create/edit our comments:

	from django.contrib import admin
	from .models import Comment

	admin.site.register(Comment)

And finally, our database configuration in `settings.py`:

	DATABASES = {
		'default': {
			'ENGINE': 'django.db.backends.mysql',
			'NAME': 'example',
			'USER': 'example',
			'PASSWORD': 'example',
			'HOST': '',
			'PORT': '',
		}
	}


If you open the admin page, and create a new comment containing an emoji:

<a href="/2014/03/31/admin_with_emoji.png"><img src="/2014/03/31/admin_with_emoji.png" style="width:600px; height:378px"></a>

Django will throw an exception:

<a href="/2014/03/31/error.png"><img src="/2014/03/31/error.png" style="width:600px; height:377px"></a>

	Incorrect string value: '\xF0\x9F\x90\xAF' for column 'text' at row 1
	
That's not good!

### Solution

One of the most useful pointer to solve this issue is [this very detailed post blog][] by [Mathias Bynens][]. Adapted to our Django app, here are the simple steps to support emojis.  

#### 1. Switching from MySQL’s `utf8` to `utf8mb4`

If you log to MySQL, and type this:

<pre><code>SHOW VARIABLES WHERE Variable_name LIKE &#39;character\_set\_%&#39; OR Variable_name LIKE &#39;collation%&#39;;</code></pre>
	
You should see:

	+--------------------------+-------------------+
	| Variable_name            | Value             |
	+--------------------------+-------------------+
	| character_set_client     | utf8              |
	| character_set_connection | utf8              |
	| character_set_database   | latin1            |
	| character_set_filesystem | binary            |
	| character_set_results    | utf8              |
	| character_set_server     | latin1            |
	| character_set_system     | utf8              |
	| collation_connection     | utf8_general_ci   |
	| collation_database       | latin1_swedish_ci |
	| collation_server         | latin1_swedish_ci |
	+--------------------------+-------------------+

So, first, we’re going to change the character set and collation properties of the database, tables, and columns, to use utf8mb4 instead of utf8.

	# For each database:
	ALTER DATABASE database_name CHARACTER SET = utf8mb4 COLLATE utf8mb4_unicode_ci;
	# For each table:
	ALTER TABLE table_name CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
	# For each column:
	ALTER TABLE table_name CHANGE column_name column_name VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;
	# (Don’t blindly copy-paste this! The exact statement depends on the column 	type, maximum length, and other properties. The above line is just an example for a `VARCHAR` column.)

You will need to adjust this snippet, in particular adapt the database name and table name to your needs. In our case, this becomes:

	ALTER DATABASE example CHARACTER SET = utf8mb4 COLLATE utf8mb4_unicode_ci;
	
	ALTER TABLE comments_comment CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
	 
	ALTER TABLE comments_comment CHANGE text text LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;

Notice the `NOT NULL` added to the end of the statement: [the Django convention is to use the empty string][], not NULL for "no data".

#### 2. Modify the server application code to use the right character sets

Hyper simple, just add <code>&#39;OPTIONS&#39;: {&#39;charset&#39;: &#39;utf8mb4&#39;}</code> to your `DATABASES` configuration:

	DATABASES = {
		'default': {
			'ENGINE': 'django.db.backends.mysql',
			'NAME': 'example',
			'USER': 'example',
			'PASSWORD': 'example',
			'HOST': '',
			'PORT': '',
			'OPTIONS': {'charset': 'utf8mb4'},
		}
	}

This should be sufficient. If you restart your server, you should be able to insert emojis in any comment:

<a href="/2014/03/31/emojis.png"><img src="/2014/03/31/emojis.png" style="width:600px; height:377px"></a>


#### 3. Check client and character sets

Finally, this third step is optional but highly recommended. In the `/etc/mysql/my.cnf` config file, you can set the following instructions:

	[client]
	default-character-set = utf8mb4
	
	[mysql]
	default-character-set = utf8mb4
	
	[mysqld]
	character-set-client-handshake = FALSE
	character-set-server = utf8mb4
	collation-server = utf8mb4_unicode_ci

Restart MySQL, and check that MySQL's configuration is correct now:

	+--------------------------+----------------------------+
	| Variable_name            | Value                      |
	+--------------------------+----------------------------+
	| character_set_client     | utf8mb4                    |
	| character_set_connection | utf8mb4                    |
	| character_set_database   | utf8mb4                    |
	| character_set_filesystem | binary                     |
	| character_set_results    | utf8mb4                    |
	| character_set_server     | utf8mb4                    |
	| character_set_system     | utf8                       |
	| character_sets_dir       | /usr/share/mysql/charsets/ |
	| collation_connection     | utf8mb4_unicode_ci         |
	| collation_database       | utf8mb4_unicode_ci         |
	| collation_server         | utf8mb4_unicode_ci         |
	+--------------------------+----------------------------+

If you want more on emojis, some highly recommended links:

- [How to support full Unicode in MySQL databases][]
- [Supporting New Emojis on iOS 6][]
- [Supporting iOS 5 New Emoji Encoding][]

From jc.

[Django]: https://www.djangoproject.com
[emojis]: http://en.wikipedia.org/wiki/Emoji
[SQLite]: https://sqlite.org/
[MySQL]: http://www.mysql.com/
[PostgreSQL]: http://www.postgresql.org
[Two Scoops of Django]: http://blog.manbolo.com/2014/02/06/two-scoops-of-django-1.6
[this very detailed post blog]: http://mathiasbynens.be/notes/mysql-utf8mb4
[Mathias Bynens]: http://twitter.com/mathias
[the Django convention is to use the empty string]: https://docs.djangoproject.com/en/1.6/ref/models/fields/#django.db.models.Field.null
[How to support full Unicode in MySQL databases]: http://mathiasbynens.be/notes/mysql-utf8mb4
[Supporting New Emojis on iOS 6]: http://blog.manbolo.com/2012/10/29/supporting-new-emojis-on-ios-6
[Supporting iOS 5 New Emoji Encoding]: http://blog.manbolo.com/2011/12/12/supporting-ios-5-new-emoji-encoding
