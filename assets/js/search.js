// console.log('ok');

//ambil elemen yang dibutuhkan untuk tempat wisata
var searchTempat = document.getElementById('search-tempat');
var tableTempat = document.getElementById('table-tempat');

//cek apakah elemen tersebut ada di halaman
if (searchTempat && tableTempat) {
    searchTempat.addEventListener('keyup', function(){
        //buat object ajax
        var xhr = new XMLHttpRequest();

        //cek kesiapan ajax
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                tableTempat.innerHTML = xhr.responseText;
            }
        }

        //eksekusi ajax
        xhr.open('GET', '/pw2024_tubes_233040043/views/search.php?search=' + searchTempat.value, true);
        xhr.send();
    });
}

//ambil elemen yang dibutuhkan untuk user
var searchUser = document.getElementById('search-user');
var tableUser = document.getElementById('table-user');

//cek apakah elemen tersebut ada di halaman
if (searchUser && tableUser) {
    searchUser.addEventListener('keyup', function(){
        //buat object ajax
        var xhr = new XMLHttpRequest();

        //cek kesiapan ajax
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                tableUser.innerHTML = xhr.responseText;
            }
        }

        //eksekusi ajax
        xhr.open('GET', '/pw2024_tubes_233040043/views/searchDataUser.php?search=' + searchUser.value, true);
        xhr.send();
    });
}

//ambil elemen yang dibutuhkan untuk user
var searchCostumer = document.getElementById('search-costumer');
var cardTempat = document.getElementById('card-tempat');

//cek apakah elemen tersebut ada di halaman
if (searchCostumer && cardTempat) {
    searchCostumer.addEventListener('keyup', function(){
        //buat object ajax
        var xhr = new XMLHttpRequest();

        //cek kesiapan ajax
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                cardTempat.innerHTML = xhr.responseText;
            }
        }

        //eksekusi ajax
        xhr.open('GET', '/pw2024_tubes_233040043/views/searchCostumer.php?search=' + searchCostumer.value, true);
        xhr.send();
    });
}
