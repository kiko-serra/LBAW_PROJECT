<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Recovery</title>
    <style>
        input {border:0;outline:0;}
        input:focus {outline:none!important;}
    </style>
    <script>
        function copyCodeToClipboard() {
            document.getElementById('code').select();
            document.execCommand('copy');
            document.getElementById('copyButton').innerText = "COPIED"
        }
    </script>    
</head>
<body style="font-family: sans-serif;">
    <div style="display: block; margin: auto; max-width: 600px;">

        <h1 style="font-size: 20px; font-weight: bold; margin-top: 20px; text-align: center;">UniLinks Password Recovery</h1>
        
        <p style="font-size: 18px; text-align: center" > Hello {{$mailData['account_tag']}} 👋</p>
            
        <div style="display: flex; flex-direction:column; align-items:center">

            <p>Here is your recovery code.</p>
            
            <input type="text" disabled value="{{$mailData['recovery_code']}}" id="code" style="color:rgb(241 245 249 / 1); background-color: rgb(75 75 79); padding: 10px; margin-bottom: 10px; text-align: center;">
            
            <div id="copyButton" style="width: 6ch; text-align:center; background-color: rgb(147 197 253 / 1); padding: 8px 14px; cursor: pointer; -webkit-user-select: none; -moz-user-select: none; user-select: none;" onclick="copyCodeToClipboard()">COPY</div>

        </div>
        
    </div>
</body>
</html>
