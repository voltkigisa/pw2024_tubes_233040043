// console.log('ok');

//ambil elemen yang dibutuhkan
var search = document.getElementById('search');
var table = document.getElementById('table');
var tombolCari = document.getElementById('tombolCari');

//tambahkan event ketika keyword ditulis
search.addEventListener('keyup', function(){
    //buat object ajax
    var xhr = new XMLHttpRequest();

    //cek kesiapan ajax
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            table.innerHTML = xhr.responseText;
        }
    }

    //eksekusi ajax
    xhr.open('GET', '/pw2024_tubes_233040043/views/search.php?search='+ search.value, true);
    xhr.send();
});
