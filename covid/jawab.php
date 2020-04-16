<?php
session_start();
// koneksi ke mysqli
$servername = "localhost";
$username = "root";
$password = "";
$db = "db_soal";
// Create connection
$koneksi = mysqli_connect($servername, $username, $password,$db);
// Check connection
if (!$koneksi) {
die("Connection failed: " . mysqli_connect_error());
}

       if(isset($_POST['submit'])){
            $pilihan=$_POST["pilihan"];
            $id_soal=$_POST["id"];
            $jumlah=$_POST['jumlah'];
            
            $score=0;
            $benar=0;
            $salah=0;
            $kosong=0;
            $alami=0;
            
            for ($i=0;$i<$jumlah;$i++){
                //id nomor soal
                $nomor=$id_soal[$i];
                
                //jika user tidak memilih jawaban
                if (empty($pilihan[$nomor])){
                    $kosong++;
                }else{
                    //jawaban dari user
                    $jawaban=$pilihan[$nomor];
                    
                    //cocokan jawaban user dengan jawaban di database
                    $query=mysqli_query($koneksi, "select * from tbl_soal where id_soal='$nomor' and knc_jawaban='$jawaban'");
                    
                    $cek=mysqli_num_rows($query);
                ?>   
                                   <?php
                    if($cek){
                        //jika jawaban cocok (benar)
                        $benar++;
                    }else{
                        //jika salah
                        $salah++;
                    }
                    
                } 
                /*RUMUS
                Jika anda ingin mendapatkan Nilai 100, berapapun jumlah soal yang ditampilkan 
                hasil= 100 / jumlah soal * jawaban yang benar
                */
                
                $result=mysqli_query($koneksi, "select * from tbl_soal WHERE aktif='Y'");
                $jumlah_soal=mysqli_num_rows($result);
                $score = 100/$jumlah_soal*$benar;
                $hasil = number_format($score,1);
                 ?>
                 

                <?php
            }
        }
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
        <form method="post">
        <title>pemeriksaan covid-19 smk wikrama</title>
        <meta charset= "utf-9">
        <link rel="stylesheet" href="style.css">
    </head>
    <form method="post">
    <style type="text/css">
        
        body{
          content: '';
            background-image: url('image/9.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            position: absolute;
            z-index: -1;
            opacity: 1.5;  
            height:100%;
            width:100%;
        }      


        .ti{
            position: absolute;
            top: 48%;
            left: 50.2%;
            transform: translate(-50%,-50%);
            color: black;
            font-size: 50px;
            text-decoration: none; 
            }
            .tii{
            position: absolute;
            top: 67%;
            left: 50%;
            transform: translate(-50%,-40%);
            color: black;
            font-size: 55px;
            text-decoration: underline; 
            }
           
            .mo{
              position: absolute;
              top: 80%;
              left: 50%;
              transform: translate(-50%,-50%);
              color: white;
              font-size: 18px;
              text-decoration: underline;
            }
    }
    </style>
    <!-- Global style END -->

</head>
<body >
    <header class="header">
    <div>
        <table border="0">
           <tr>
               <td></td>
               
           </tr>
           <tr>
               <td></td>  
           </tr>
           <tr>
               <td></td> 
           </tr>
           <tr>
               <td></td>  
           </tr>
           <tr>
               <td></td>
           </tr>
            <tr>
               <td></td>  
           </tr>
           <tr>
               <td></td> 
           </tr>
           <tr>
               <td></td>  
           </tr>
           <tr>
               <td></td>
           </tr>


       </table>
       <table border="0" align="center">
           <tr>
               <td align="center" ><H1>BIODATA</H1></td>
               
           </tr>
           <tr>
               <td align="center" ><?php echo "Nama ".$_SESSION['nama']; ?></td>  
           </tr>
           <tr>
               <td align="center" ><?php echo "Umur ".$_SESSION['umur']; ?></td> 
           </tr>
           <tr>
               <td align="center"><?php echo "Jenis kelamin ".$_SESSION['jk']; ?></td>  
           </tr>
           <tr>
               <td align="center" ><?php echo "Alamat ".$_SESSION['almt']; ?></td>
           </tr>


       </table>
       <table border="0">
           <tr>
               <td></td>
               
           </tr>
           <tr>
               <td></td>  
           </tr>
           <tr>
               <td></td> 
           </tr>
           <tr>
               <td></td>  
           </tr>
           <tr>
               <td></td>
           </tr>

       </table>
      
        <div class="ti" align="center">
               <?php
            echo "
                <tr>
                <td>Resiko tubuh anda terhadap covid-19</td>
                <td>:  </td>
                </tr>
                </table>
                </div>";
        ?>

    </div>
    <div class="tii" align="center">
    <?php 
    
                    $salah ;
                    if($salah < 8){
                    echo "RENDAH";
                    }elseif($salah < 15){
                    echo "SEDANG";
                    }else{
                    echo "TINGGI";
                        }
                    
            ?>
            </div>
    
          
        <div class="mo" align="center">
            <a class="btn btn-primary" href="logout.php">Mulai Lagi </a>
        </div>
        </header>
</body>
</html>