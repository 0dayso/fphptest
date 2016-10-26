<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title></title>
    <script type="text/javascript" src="http://lib.sinaapp.com/js/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="assets/third-party/phaser3.0/phaser.min.js"></script>
</head>

<body>

    <div id="example"></div>
    
    <script type="text/javascript">
    var game = new Phaser.Game(800, 600, Phaser.CANVAS, 'example', { preload: preload, create: create, render: render });

    function preload() {

        //  Phaser can load Text files.

        //  It does this using an XMLHttpRequest.
        
        //  If loading a file from outside of the domain in which the game is running 
        //  a 'Access-Control-Allow-Origin' header must be present on the server.
        //  No parsing of the text file is performed, it's literally just the raw data.

        game.load.text('html', 'http://phaser.io');

    }

    var text;

    function create() {

        game.stage.backgroundColor = '#0072bc';

        var html = game.cache.getText('html');

        text = html.split('\n');

    }

    function render() {

        for (var i = 0; i < 30; i++)
        {
            game.debug.text(text[i], 32, i * 20);
        }

    }
    </script>
</body>
</html>