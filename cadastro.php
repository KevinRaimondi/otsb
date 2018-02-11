<?php
// Conexão com o banco de dados
require ("conexao.php");

$path = "img/profile/";

// Se o usuário clicou no botão cadastrar efetua as ações
if (isset($_POST['cadastrar'])) {
	
	// Recupera os dados dos campos
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$foto = $_FILES["foto"];
	
	// Se a foto estiver sido selecionada
	if (!empty($foto["name"])) {
		
		// Largura máxima em pixels
		$largura_max = 151;
		// Altura máxima em pixels
		$altura_max = 151;
		// Tamanho máximo do arquivo em bytes
		$tamanho = 100000;

		$error = array();

    	// Verifica se o arquivo é uma imagem
		if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
			$error[1] = "Isso não é uma imagem.";
		} 

		// Pega as dimensões da imagem
		$dimensoes = getimagesize($foto["tmp_name"]);

		// Verifica se o tamanho da imagem é maior que o tamanho permitido
		if($foto["size"] > $tamanho) {
			$error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
		}

		$largura_orig = $dimensoes[0];
		$altura_orig = $dimensoes[1];


		// Calculando a proporção
		$ratio_orig = $largura_orig/$altura_orig;

		// inverte a comparação e calcula o offset
		if ($largura_max/$altura_max < $ratio_orig) { 
			$dif_w = $altura_max*$ratio_orig/2-$altura_max;
			$dif_h = 0;
		} else {
			$dif_w = 0;
			$dif_h = $largura_max/$ratio_orig/2-$largura_max;
		}

		$image_p = imagecreatetruecolor($largura_max, $altura_max);
		$image = imagecreatefromjpeg($foto);
		imagecopyresampled($image_p, $image, -$dif_w, -$dif_h, 0, 0, $largura_max, $altura_max, $largura_orig, $altura_orig);

		$foto = imagejpeg($image, $foto["name"], 75);



		// Verifica se a largura da imagem é maior que a largura permitida
		//if($dimensoes[0] > $largura) {
		//	$error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
		//}

		// Verifica se a altura da imagem é maior que a altura permitida
		//if($dimensoes[1] > $altura) {
		//	$error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
		//}
		

		// Se não houver nenhum erro
		if (count($error) == 0) {

			// Pega extensão da imagem
			preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

        	// Gera um nome único para a imagem
			$nome_imagem = md5(uniqid(time())) . "." . $ext[1];

        	// Caminho de onde ficará a imagem
			$caminho_imagem = $path . $nome_imagem;

			// Faz o upload da imagem para seu respectivo caminho
			move_uploaded_file($foto["tmp_name"], $caminho_imagem);

			// Insere os dados no banco
			$sql = mysqli_query($conn, "INSERT INTO usuarios VALUES ('', '".$nome."', '".$email."', '".$nome_imagem."')");

			// Se os dados forem inseridos com sucesso
			if ($sql){
				echo "Você foi cadastrado com sucesso.";
			}else{
				unlink($caminho_imagem);
				echo $caminho_imagem;
			}
		}

		// Se houver mensagens de erro, exibe-as
		if (count($error) != 0) {
			foreach ($error as $erro) {
				echo $erro . "<br />";
			}
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Cadastro de usuário</title>
</head>

<body>
	<h1>Novo Usuário</h1>
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="cadastro" >
		Nome:<br />
		<input type="text" name="nome" /><br /><br />
		Email:<br />
		<input type="text" name="email" /><br /><br />
		Senha:<br />
		<input type="password" name="senha" /><br /><br />
		Foto de exibição:<br />

		<input type="file" name="foto" accept="image/jpeg" /><br /><br />
		<input type="submit" name="cadastrar" value="Cadastrar" />
	</form>

	<hr />

	<h1>Usuários cadastrados</h1>
	<?php
// Seleciona todos os usuários
	$sql = mysqli_query($conn, "SELECT * FROM usuarios ORDER BY nome");

// Exibe as informações de cada usuário
	while ($usuario = mysqli_fetch_object($sql)) {
	// Exibimos a foto
		echo "<img src='".$path.$usuario->foto."' alt='Foto de exibição' /><br />";
	// Exibimos o nome e email
		echo "<b>Nome:</b> " . $usuario->nome . "<br />";
		echo "<b>Email:</b> " . $usuario->email . "<br /><br />";
	}


	?>
</body>
</html>