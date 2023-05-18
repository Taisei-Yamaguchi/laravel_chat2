<html>
    <head>
        <title>@yield('title')</title>
        <style>
            body {font-size:10pt; margin: 5px;}
            h1 {font-size:50pt; text-align:right; color:#aaa;
            margin:-20px 0px -30px 0px; letter-spacing:-4pt;}
            ul{font-size:12pt;}
            hr{color:gray;}
            .menutitle{font-size:14pt; font-weight:bold; margin:0px;}
            .content{margin:10px;}
            .footer{text-align:right; font-size:10pt; margin:10px;
            border-bottom:solid 1px #ccc; color:#ccc;}
            th{background-color:#aaa; color:fff; padding:5px 10px;}
            td{border:solid 1px #aaa; color:#999; padding:5px 10px;}
        </style>
         <link rel="stylesheet" href="{{asset('/css/chatapp.css')}}">
         
    </head>
    <body>
        <h1>@yield('title')</h1>
        <div class="content">
            @yield('content')
        </div>
        <div class="footer">
            @yield('footer')
        </div>
    </body>
</html>