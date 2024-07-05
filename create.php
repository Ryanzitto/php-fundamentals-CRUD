<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário de Criação de Produto</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="w-screen h-screen flex flex-col">
  <header class="w-full h-20 flex">
    <nav class="w-full h-full flex items-center px-10">
      <ul class="flex gap-4">
        <li class="text-md text-zinc-700 cursor-pointer hover:text-zinc-400 transition-all">
          <a href="index.php">
            Home
          </a>
        </li>
        <li class="text-md text-zinc-700 cursor-pointer hover:text-zinc-400 transition-all">
          <a href="create.php">
            Create
          </a>
        </li>
      </ul>
    </nav>
  </header>
  <main class="w-full p-10 flex flex-col items-center">
    <h1 class="text-3xl font-bold mb-4">CREATE</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="flex w-[500px] flex-col gap-4">
      <label for="imagem">imagem:</label>
      <input class="bg-zinc-100 p-2 border border-zinc-300" placeholder="https://imagem.com" type="text" name="imagem"
        id="imagem">

      <label for="preco">Preço:</label>
      <input class="bg-zinc-100 p-2 border border-zinc-300" placeholder="99999" type="text" name="preco" id="preco">

      <label for="desc">Descrição:</label>
      <input class="bg-zinc-100 p-2 border border-zinc-300" placeholder="Este produto inovou o mercad..." type="text"
        name="desc" id="desc">

      <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
        Criar Produto
      </button>
    </form>

    <?php
    include "db.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $imagem = htmlspecialchars($_POST['imagem']);
        $preco = htmlspecialchars($_POST['preco']);
        $desc = htmlspecialchars($_POST['desc']);
        
        $sql = "INSERT INTO produto (imagem, preco, descricao) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("sds", $imagem, $preco, $desc);
            $stmt->execute();

            echo "<p class='text-green-500'>Produto criado com sucesso!</p>";

            $stmt->close();
        } else {
            echo "<p class='text-red-500'>Erro ao preparar a consulta</p>";
        }

        $conn->close();
        
        echo "<p class='text-green-500'>Produto criado com sucesso!</p>";
    }
    ?>
  </main>
</body>

</html>