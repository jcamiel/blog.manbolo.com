## Analysing iOS App Network Performances on Cellular/Wi-Fi

There are good chances that, at a point, your app is connected and talk to a backend. Having best network performances is crucial, maybe as important as the responsiveness of the UI. Instruments provides good built-in tools for analysing memory, cpu, leaks, fps but analysing an app network performances is not easy.

There are a lot of different methods [here][] and [here for instance][] to inspect how behave your app, and for the most part the presented solution is to enable a HTTP proxy on the iPhone Wi-Fi interface and capture Wi-Fi packets.  There is also an [Apple Technical Q&A here][] that describes in details how to capture packets, but I'm going to present a method that can also works when you want to analyse your app on a 3G/Edge connection, or if you can't have a proxy on the Wi-Fi connection.  

1. [__Create a remote virtual interface (RVI) on your iPhone__](#1)
2. [__Capture packets using <code>tcpdump</code> in a .pcap file__](#2)
3. [__Using HAR (HTTP Archive) file format__](#3) 
4. [__Instruments network profiling__](#4)


<h3 id="1">1. Create a remote virtual interface (RVI) on your iPhone</h3>

Really easy, just plug your iPhone to your Mac via USB and type in a terminal

	rvictl -s abcdef01234563e91f1f2f8a8cb0841d2dafeebbc

where `abcdef01234563e91f1f2f8a8cb0841d2dafeebbc` is the UDID of your iPhone. You whould see

	$ Starting device abcdef01234563e91f1f2f8a8cb0841d2dafeebbc [SUCCEEDED]

You can check that you have a new network interface

	ifconfig -l

will give you 

	$ lo0 gif0 stf0 en0 en1 p2p0 fw0 rvi0
	
where `rvi0` is the new remote virtual interface. When you'll be done, you will be able to delete the RVI 

	rvictl -x abcdef01234563e91f1f2f8a8cb0841d2dafeebbc

will ouput

	$ Stopping device 74bd53c647548234ddcef0ee3abee616005051ed [SUCCEEDED]
  
<h3 id="2">2. Capture packets using <code>tcpdump</code> in a .pcap file</h3>

After having instanciate a RVI, type in a terminal

	sudo tcpdump -i rv0 -n -s 0 -w dumpFile.pcap tcp

This will start the capture of TCP packets on the remote interface

- `-i rv0` causes `tcpdump` to capture on the RVI
- `-n` option means that addresses are not converted to domain names (which is faster) 
- `-s 0` option causes `tcpdump` to capture the entire packet and not just the first bytes
- `-w dumpFile.pcp` option specifies the output file, in libpcap file format.  
- `tcp` option to capture only TCP packets.

On the device, launch your app, play with it and once you've finished, quit `tcpdump`. At this point, you can also close your remove virtual interface

	rvictl -x abcdef01234563e91f1f2f8a8cb0841d2dafeebbc

Once we have this pcap file, there is still some work in order to load this file in our favorite analyser tool. The TCP packets have been captured in RAW format and most of the tools work only on Ethernet captured packed. To convert this pcap file, you will need to install `tcpreplay` (with [Homebrew][] for instance)

	brew install tcpreplay
	
`tcprewrite` is a part of `tcpreplay` suite and can be used to convert your raw packets capture to Ethernet packets capture

	tcprewrite --dlt=enet --enet-dmac=00:11:22:33:44:55 --enet-smac=66:77:88:99:AA:BB --infile=dumpFile.pcap --outfile=dumpFileFinal.pcap
	  
Now, your packet is ready to be analysed via your favorite tool, like [Charles HTTP Proxy][] or [Wireshark][].

<img src="/2013/02/22/charles.png" alt="Charles" width="600" height="135">

<h3 id="3">3. Using HAR (HTTP Archive) file format</h3>

[HTTP Archive (HAR)][] is an open file format for archiving HTTP packets. The really good news is that there is a [lot of tools (often free) available][] to analyse, visualize HAR files. For instance, provided you have a HAR captured file, you can preview it online with the [HAR Viewer][]

![HAR viewer result][]

You can convert the .pcap captured file to HAR with a Python script, `pcap2har`. `pcap2har` depends on the `dpkt` packet-parsing library (<http://code.google.com/p/dpkt/>) so we need to install it first. Download the [dpkt latest version tar.gz][], untar it on your disk, go to the `dpkt-1.7` directory and type

	sudo python setup.py install
	
to install `dpkt` in your Python 2 package library.	

Now, clone the lastest `pcap2har` version at <https://github.com/andrewf/pcap2har> on your disk. Then, to convert your .pcap file to HAR

	./main.py dumpFileFinal.cap dumpFileFinal.har	

Be sure to convert the .pcap file that has been rewrite with `tcprewrite`, otherwise the conversion will fail.

<h3 id="4">4. Instruments network profiling</h3>

If you have the source code of the application, you can try to profile it with Instruments ( Xcode > Product > Profile then choose Network template).

![Instrument network template][]

I've played a little with the network activities, but I find it hard to extract useful informations for analysing. Let's hope Apple will improve the tool to profile network activities and bring it to the same level as the [Instrument OpenGL template][] for instance. 

From jc.

[Charles HTTP Proxy]: http://www.charlesproxy.com/
[Wireshark]: http://www.wireshark.org/
[homebrew]: http://mxcl.github.com/homebrew/
[Apple Technical Q&A here]: http://developer.apple.com/library/mac/#qa/qa1176/_index.html#//apple_ref/doc/uid/DTS10001707-CH1-SECRVI
[HTTP Archive (HAR)]: http://www.softwareishard.com/blog/har-12-spec/
[HAR Viewer]: http://www.softwareishard.com/har/viewer/
[lot of tools (often free) available]: http://www.softwareishard.com/blog/har-adopters/
[Charles]: charles.png
[Instrument OpenGL template]: http://blog.manbolo.com/2012/11/20/using-xcode-opengl-es-frame-capture
[HAR viewer result]: harpreview.png
[Instrument network template]: instrument.png
[dpkt latest version tar.gz]: http://dpkt.googlecode.com/files/dpkt-1.7.tar.gz
[here]: http://useyourloaf.com/blog/2012/02/07/remote-packet-capture-for-ios-devices.html
[here for instance]: http://www.tuaw.com/2011/02/21/how-to-inspect-ioss-http-traffic-without-spending-a-dime/


