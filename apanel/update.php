<?php
include "../connection.php";
if(isset($_GET['id'])&&isset($_GET['stat']))
{
    $id=$_GET["id"];
    $status=$_GET["stat"];

    //get data
    $q="SELECT stok FROM daftar_barang WHERE kode_barang='".$id."'";
    $res=$conn->query($q);
    $res=$res->fetch_assoc();
    $res=$res["stok"];

    //update data with status
    if($status=="plus")
    {
        $res = $res + 1;
        $q="UPDATE daftar_barang SET stok='".$res."' WHERE kode_barang='".$id."'";
        $conn->query($q);
    }
    else if($status=="minus")
    {
        if($res>0)
        {
            $res = $res - 1;
            $q="UPDATE daftar_barang SET stok='".$res."' WHERE kode_barang='".$id."'";
            $conn->query($q);
        }
    }
}
else if(isset($_GET['idlog']))
{
    $id=$_GET['idlog'];
    $q="UPDATE log_peminjaman SET status='KEMBALI' WHERE kode_peminjaman='".$id."'";
    $conn->query($q);
}

header("location:admpanel.php");
?>