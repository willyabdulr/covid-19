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
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pertanyaan</title>
    
<body>

  
       <table bgcolor="#DCDCDC" width="100%" height="20%" align="center">
       <tr> 
        
    <td align="center" bgcolor="#A9A9A9"><h1><?php echo "Selamat Datang ".$_SESSION['nama']; ?></h1></td>
    <tr>    
    <td align="center" bgcolor=""><h3>Daftar Pertanyaan</h3></td>
    </tr>
    <tr>
    <td align="center" bgcolor=""><b>Penilaian Resiko Pribadi Covid-19</b></td>
     </tr>
        </table>

</body>
</html>
<?php
    
echo "<div style='width:100%; border: 1px solid ##8C00C8; overflow:scroll;height:700px;'>";
 echo '<table width="100%" border="0">';


        $hasil=mysqli_query($koneksi, "select * from tbl_soal WHERE aktif='Y' ORDER BY RAND ()");
        $jumlah=mysqli_num_rows($hasil);
        $urut=0;
        while($row =mysqli_fetch_array($hasil))
        {
            $id=$row["id_soal"];
            $pertanyaan=$row["soal"];
            $pilihan_a=$row["a"];
            $pilihan_b=$row["b"];
           
            
            ?>
            <form name="form1" method="post" action="jawab.php">
            <input type="hidden" name="id[]" value=<?php echo $id; ?>>
            <input type="hidden" name="jumlah" value=<?php echo $jumlah; ?>>
            <tr>
                  <td width="17"><font color="#000000"><?php echo $urut=$urut+1; ?></font></td>
                  <td width="430"><font color="#000000"><?php echo "$pertanyaan"; ?></font></td>
            </tr>
            <?php
                if (!empty($row["gambar"])) {
                    echo "<tr><td></td><td><img src='foto/$row[gambar]' width='200' hight='200'></td></tr>";
                }
            ?>
            <tr>
                  <td height="21"><font color="#yellow">&nbsp;</font></td>
                <td><font color="#yellow">
                 <input name="pilihan[<?php echo $id; ?>]" type="radio" value="A"> 
                <?php echo "$pilihan_a";?></font> </td>
            </tr>
            <tr>
                  <td><font color="#yellow">&nbsp;</font></td>
                <td><font color="#yellow">
                <input name="pilihan[<?php echo $id; ?>]" type="radio" value="B"> 
                <?php echo "$pilihan_b";?></font> </td>
            </tr>
            
            
        <?php
        }
        ?>
            <tr >
                <td>&nbsp;</td>
                  <td width="100" height="100"><input type="submit" name="submit" value="Lihat Hasil" onclick="return confirm('Apakah Anda yakin dengan jawaban Anda?')"></td>
            </tr>
            </table>
</form>
        </p>
</div>