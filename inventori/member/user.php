<?php session_start();
include_once("../koneksi.php");
$result = mysqli_query($koneksi, "SELECT * FROM users ORDER BY nik DESC");

if( !isset($_SESSION['user']) )
{
	header('location:./../'.$_SESSION['akses']);
	exit();
}else{
	$nama = $_SESSION['user'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>User</title>
	<link rel="shortcut icon" href="../images/icon.ico">
		<!--Import Google Icon Font-->
		<link rel="stylesheet" type="text/css" href="../css/material-icon"/>
		<!--Import materialize.css-->
		<link rel="stylesheet" type="text/css" href="../css/materialize.min.css" media="screen,projection"/>
		<!--custom css-->
		<link rel="stylesheet" type="text/css" href="../css/custom.css">
		<link rel="stylesheet" href="../css/style.css">

		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<style type="text/css">
			header, main, footer {
				padding-left: 300px;
			}

			@media only screen and (max-width : 992px) {
				header, main, footer {
				padding-left: 0;
				}
			}
		</style>

</head>
<body>
	<header>
		<!--TopNav-->
	    <nav>
	    	<div class="row top-nav red darken-2 nav-wrapper">
				<div class="col s6 offset-s1">
					<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
					<a>User</a>
				</div>
			</div>
		</nav>

		<!--SIDENAV-->
		<ul id="slide-out" class="sidenav sidenav-fixed">
			<li class="no-padding">
				<ul class="collapsible collapsible-accordion">
	                <li>
	                	<div class="user-view">
	                    	<div class="background" style="margin-bottom:-15%;">
	                    		<img src="../images/bg.jpg">
	                    	</div>
	                		<span class="white-text name"><?php echo $nama; ?><i class="material-icons left">account_circle</i></span>
	                	</div>
	                </li>
	                
	                <li><div class="divider" style="margin-top:15%;"></div></li>

	                <li><a href="index.php" class="collapsible-header">Beranda<i class="material-icons">home</i></a></li>

	                <li>
	                	<a class="collapsible-header">Menu<i class="material-icons">arrow_drop_down</i></a>
	                	<div class="collapsible-body">
	                		<ul>
	                			<li class="active red darken-4"><a href="user.php">User</a></li>
								<li><a href="inputbarang.php">Input Barang</a></li>
								<li><a href="gudang.php">Gudang</a></li>
								<li><a href="barangkeluar.php">Barang Keluar</a></li>
							</ul>
						</div>
	                </li>
	                <li><a href="../logout.php" class="collapsible-header">Keluar<i class="material-icons">exit_to_app</i></a></li>

	            </ul>
			</li>
		</ul>
	</header>
	<!--end of header-->

	<!--content-->
		<main>
			<div class="row">
			  <div id="admin" class="col s10 offset-s1"> <br>
			    <div class="card material-table">
			      <div class="table-header">
			        <span class="table-title">Data User</span>
			        <div class="actions">
			          <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
			        </div>
			      </div>
			      <table id="datatable">
			        <thead>
			          <tr>
			          	<th hidden>ID</th>
			          	<th>NIK</th>
			            <th>Nama</th>
			            <th>Tanggal Lahir</th>
			            <th>Alamat</th>
			            <th>Telepon</th>
			            <th>Status</th>
			            <th>Divisi</th>
			            <th>LOKER</th>
			          </tr>
			        </thead>
			        <tbody>
			        	<?php 

							while($user_data = mysqli_fetch_array($result)) { 
			                    $test = $user_data['nama']; 
				                echo "<tr>";
			                    echo "<td hidden>".$user_data['id']."</td>";
				                echo "<td> ".$user_data['nik']."</td>";
				                echo "<td> ".$user_data['nama']." </td>";
				                echo "<td>".$user_data['tgl_lahir']."</td>";
				                echo "<td>".$user_data['alamat']."</td>";
				                /*
				                $lenght = 15;
				                $alamat = strlen($user_data['alamat']);
				                if ($alamat > $lenght) {
				                echo "<td> ".substr($user_data['alamat'], 0, $lenght).' ...'." </td>";
				                }else{
				                	echo "<td> ".$user_data['alamat']." </td>";
				                } */
				                echo "<td>".$user_data['telepon']."</td>";
				                if ($user_data['level'] == 'admin') {
				                	echo "<td style='text-transform: capitalize;'> <span class='new badge blue' data-badge-caption=''>".$user_data['level']."</span></td>"; 
				                }else {
				                	echo "<td style='text-transform: capitalize;'> <span class='new badge red' data-badge-caption=''>".$user_data['level']."</span></td>"; 
				                }
			                    echo "<td>".$user_data['divisi']."</td>"; 
			                    echo "<td>".$user_data['loker']." </td>";  
				                echo "</tr>";
				            }

						?>
			        </tbody>
			      </table>
			    </div>
			  </div>
			</div>
		</main>
        <!--end of content-->

	<!--Import jQuery before materialize.js-->
	<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../js/materialize.min.js"></script>
	<script src='../js/jquery.dataTables.min.js'></script>
	<script  src="../js/index.js"></script>
	<script>
		$(document).ready(function(){
			$('.sidenav').sidenav();
			$('.collapsible').collapsible();
		});
	</script>
	<script>
        $(".hapus").click(function () {
        var jawab = confirm("Anda Yakin Ingin Menghapus User ?");
        if (jawab === true) {
        // konfirmasi
            var hapus = false;
            if (!hapus) {
                hapus = true;
                $.post('delete.php', {id: $(this).attr('data-id')},
                function (data) {
                    alert(data);
                });
                hapus = false;
            }
        } else {
            return false;
        }
        });
      </script>
</body>
</html>