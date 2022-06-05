<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Data Mahasiswa</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>

        <link rel="stylesheet"
        href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700;800;900&display=swap" rel="stylesheet">   

    </head>
    <body>

    <?php
  require_once("sparqllib.php");
  $test = "";
  if (isset($_POST['search-magang'])) {
    $test = $_POST['search-magang'];
    $data = sparql_get(
      "http://localhost:3030/anakmagang",
      "
      prefix ab: <http://learningsparql.com/ns/addressbook#> 
      prefix d:  <http://learningsparql.com/ns/data#> 
      prefix media: <https://www.ldf.fi/service/rdf-grapher> 

      SELECT ?Nama ?NPM ?Angkatan ?NamaPerusahaan ?DeskripsiPerusahaan ?EmailPerusahaan ?KontakPerusahaan ?BidangMagang
    WHERE
    { 
        ?d  ab:Nama ?Nama ;
            ab:NPM ?NPM;
            ab:Angkatan ?Angkatan ;
            ab:NamaPerusahaan ?NamaPerusahaan;
            ab:DeskripsiPerusahaan ?DeskripsiPerusahaan;
            ab:EmailPerusahaan ?EmailPerusahaan ;
            ab:KontakPerusahaan ?KontakPerusahaan;
            ab:BidangMagang ?BidangMagang.        
    
            FILTER (regex (?Nama,  '$test', 'i')  
            || regex (?NPM,  '$test', 'i') 
            || regex (?Angkatan,  '$test', 'i') 
            || regex (?NamaPerusahaan,  '$test', 'i') 
            || regex (?DeskripsiPerusahaan,  '$test', 'i') 
            || regex (?EmailPerusahaan,  '$test', 'i') 
            || regex (?KontakPerusahaan,  '$test', 'i')
            || regex (?BidangMagang,  '$test', 'i'))
        }"
    );
  } else {
    $data = sparql_get(
      "http://localhost:3030/anakmagang",
      "
      prefix ab: <http://learningsparql.com/ns/addressbook#> 
      prefix d:  <http://learningsparql.com/ns/data#> 
      prefix media: <https://www.ldf.fi/service/rdf-grapher> 

      SELECT ?Nama ?NPM ?Angkatan ?NamaPerusahaan ?DeskripsiPerusahaan ?EmailPerusahaan ?KontakPerusahaan ?BidangMagang
      WHERE
      { 
          ?d  ab:Nama ?Nama ;
              ab:NPM ?NPM;
              ab:Angkatan ?Angkatan ;
              ab:NamaPerusahaan ?NamaPerusahaan;
              ab:DeskripsiPerusahaan ?DeskripsiPerusahaan;
              ab:EmailPerusahaan ?EmailPerusahaan ;
              ab:KontakPerusahaan ?KontakPerusahaan;
              ab:BidangMagang ?BidangMagang.        
        }
            "
    );
  }

  if (!isset($data)) {
    print "<p>Error: " . sparql_errno() . ": " . sparql_error() . "</p>";
  }

  ?>
       

         <!-- Home Section -->
        <section class="home" id="home">
            <div class="home-text">
                <h1>Anak Magang Himatif</h1>
                <h2>Kumpulan Data Magang Mahasiswa TI UNPAD <br>  <br> </h2>
            </div>

            <div class="logo-img">
                <img src="logo.png">
            </div>
        </section>

        

        <section class="search" id="search">
            <div class="search">
                <h2>Cari Kumpulan Data Anak Magang HIMATIF UNPAD</h2>
                    <div class="form-box">
                    <form class="d-flex" role="search" action="" method="post" id="search-magang" name="search-magang">
                    <input class="search-field srch" type="search" placeholder="Ketik keyword disini" aria-label="Search" name="search-magang">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                    
                    </div> 
            </div>
        </section>

       <!-- Result Section -->
       <section class="result" id="result">
        <div class="row text-center mb-3 hasil">
          <div class="col">
            <h2>Hasil Pencarian</h2>
          </div>
        </div>
        <div class="row fs-5">
          <div class="col-md-5">
            <p>
              Menampilkan pencarian :
              <br />
            </p>
            <p>
              <span>
          <?php
          if ($test != NULL) {
            echo $test;
          } else {
            echo "  Data Yang Dicari :";
          }
          ?></span>
            </p>
          </div>
        </div>
          
        <div class="row">

        <?php $i = 0; ?>
        <?php foreach ($data as $datas ): ?>
        <div class="col-md-4">
        <div class="box"> 
        <ul class="list-group list-group-flush">

        <div class="header-data"> <b>Nama  :</b></div>
        <div class="item-data"><?= $datas['Nama']; ?></div>
  
        <div class="header-data"> <b>NPM :</b></div>
        <div class="item-data"><?= $datas['NPM']; ?></div>
        
        <div class="header-data"> <b>Angkatan :</b></div>
        <div class="item-data"><?= $datas['Angkatan']; ?></div>

        <div class="header-data"> <b>Nama Perusahaan :</b></div>
        <div class="item-data"><?= $datas['NamaPerusahaan']; ?></div>

        <div class="header-data"> <b>Deskripsi Perusahaan :</b></div>
        <div class="item-data"><?= $datas['DeskripsiPerusahaan']; ?></div>

        <div class="header-data"> <b>Email Perusahaan :</b></div>
        <div class="item-data"><?= $datas['EmailPerusahaan']; ?></div>

        <div class="header-data"> <b>Kontak Perusahaan :</b></div>
        <div class="item-data"><?= $datas['KontakPerusahaan']; ?></div>

        <div class="header-data"> <b>Bidang Magang :</b></div>
        <div class="item-data"><?= $datas['BidangMagang']; ?></div>
        <br>
      </ul>
    </div>
  </div>
 <?php endforeach; ?>
</div>

        </section>


    </body>
</html>