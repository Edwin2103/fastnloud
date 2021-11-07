		<?php
		 if(!isset($_SERVER['HTTP_REFERER'])){ // redirect them to your desired location 
		 	header('location:../index.php'); 
		 	exit; 
		} 

		    if(isset($_SESSION['id'])){
		    	redir("./");
		    }
			include "../configs/config.php";
			include "../configs/funciones.php";
			include 'layouts/header.php';
		?>
	</head>
	<body > 
		<?php
			include 'layouts/nav.php';

		?>
		<footer style="background-color:black">
			<?php
				include 'layouts/footer.php';
			?>
		</footer>
	</body>
</html>