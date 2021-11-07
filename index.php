		<?php
			include "configs/config.php";
			include "configs/funciones.php";
			include 'layouts/header.php';
		?>
	</head>
	<body > 
		<?php
			include 'layouts/nav.php';
		?>
		<main class="site-wrapper">
		</main>
		<footer style="background-color:black">
			<?php
				include 'layouts/footer.php';
			?>
		</footer>
	</body>
</html>

<style type="text/css">
    @media screen and (min-width: 767px){
      .item{
        width: calc((100% - 20px) / 3);
      }
    }
    @media screen and (max-width: 1200px){
      .item{
        width: calc((100% - 5px) / 1);

      }
    }
    @media(max-width: 450px){
      .item{
        width: 90%;
        margin-left: auto;
        margin-right: auto;
      }
}
</style>