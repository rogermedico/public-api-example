document.getElementById('copy-clipboard').addEventListener('click', function (){
   const token = document.getElementById('token').innerText;
   navigator.clipboard.writeText(token)
});
