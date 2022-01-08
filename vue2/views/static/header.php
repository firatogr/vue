<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            c = t => {console.log(t)}
            const url = '<?php echo URL ?>'
            var prevHTMLs = {}
            prevHTMLs[document.location.href] = document.querySelector('.content').innerHTML
            aPage = function(e) {
                e.preventDefault()
                var request = new XMLHttpRequest()
                request.open('POST', url + e.target.getAttribute('href'))
                request.send((new FormData()).append('just_content', '.content'))
                request.addEventListener('load', response => {
                    if (response.currentTarget.status >= 200 && response.currentTarget.status < 400) {
                        var el = document.createElement('div')
                        el.innerHTML = response.currentTarget.response
                        prevHTMLs[document.location.href] == undefined ? prevHTMLs[document.location.href] = document.querySelector('.content').innerHTML : null
                        document.querySelector('.content').innerHTML = el.querySelector('.content').innerHTML
                    }
                })
                window.history.pushState(null, null, url + e.target.getAttribute('href'))
            }
            window.addEventListener('popstate', function () {
                if (prevHTMLs[document.location.href] != undefined) {
                    document.querySelector('.content').innerHTML = prevHTMLs[document.location.href]
                }
            })
        })
    </script>
</head>
<body>
<!-- HEADER KODLARI -->
<div class="content">