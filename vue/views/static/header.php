<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            c = t => {console.log(t)}
            const main_url = document.location.href
            const url = '<?php echo URL ?>'
            var prevHTMLs = {}
            prevHTMLs[document.location.href] = document.querySelector('.content').innerHTML
            document.querySelectorAll('a:not([data-direct-no])').forEach(a => {
                a.addEventListener('click', e => {
                    e.preventDefault()
                    var request = new XMLHttpRequest()
                    request.open('POST', url + e.target.getAttribute('href'))
                    request.send((new FormData()).append('just_content', '.content'))
                    request.addEventListener('load', response => {
                        if (response.currentTarget.status >= 200 && response.currentTarget.status < 400) {
                            var el = document.createElement('div')
                            el.innerHTML = response.currentTarget.response
                            c(document.querySelector('.content').innerHTML)
                            prevHTMLs[document.location.href] == undefined ? prevHTMLs[document.location.href] = document.querySelector('.content').innerHTML : null
                            document.querySelector('.content').innerHTML = el.querySelector('.content').innerHTML
                        }
                    })
                    window.history.pushState(null, null, url + e.target.getAttribute('href'))
                })
            })
            window.addEventListener('popstate', () => {
                if (prevHTMLs[document.location.href] != undefined) {
                    document.querySelector('.content').innerHTML = prevHTMLs[document.location.href]
                }
            })
        })
    </script>
</head>
<body>