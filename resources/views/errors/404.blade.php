<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-800 h-screen flex flex-col items-center justify-center text-white">

    <h1 id="text" class="text-5xl font-mono"></h1>
    <h2 id="info" class="text-3xl font-mono"></h2>

    <script>
        const chars = [
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's',
            't', 'u', 'v', 'w', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S',
            'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            ' ', "'", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0",
            '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_', '=', '+', '[', ']', '{', '}',
            '|', ';', ':', ',', '.', '<', '>', '/', '?', '`', '~'
        ];


        //This is cpu based so it might be slow on old cpus
        //Might change 404 page again
        function glitchText(targetId, text) {
            const len = text.length;
            let output = "";
            let progress = 0;

            function glitch() {
                if (progress >= len) {
                    return;
                }
                let randomNum = Math.floor(Math.random() * chars.length);
                if (chars[randomNum] == text[progress]) {
                    output += text[progress];
                    document.getElementById(targetId).innerHTML = output;
                    progress++;
                } else {
                    document.getElementById(targetId).innerHTML = output + chars[randomNum];
                }
                requestAnimationFrame(glitch);
            }

            window.addEventListener("load", function() {
                document.getElementById(targetId).innerHTML = "";
                glitch();
            });
        }

        glitchText("text", "404");
        glitchText("info", "Page not found.");
    </script>

</body>

</html>
