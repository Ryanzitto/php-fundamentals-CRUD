<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Update</title>
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
    <h1 class="text-3xl font-bold mb-4">UPDATE</h1>

    <?php
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          include "db.php";

          $id = intval($_GET['id']);
          $imagem = htmlspecialchars($_POST['imagem']);
          $preco = htmlspecialchars($_POST['preco']);
          $desc = htmlspecialchars($_POST['desc']);

          $sql = "UPDATE produto SET imagem = ?, descricao = ?, preco = ? WHERE id = ?";
          $stmt = $conn->prepare($sql);

          if ($stmt) {
              $stmt->bind_param("ssdi", $imagem, $desc, $preco, $id);
              $stmt->execute();

              echo "<p class='text-green-500'>Produto atualizado com sucesso!</p>";

              $stmt->close();
          } else {
              echo "<p class='text-red-500'>Erro ao preparar a consulta</p>";
          }
      }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $_GET['id']; ?>" method="POST"
      class="flex w-[500px] flex-col gap-4">
      <label for="imagem">Imagem:</label>
      <input class="bg-zinc-100 p-2 border border-zinc-300" placeholder="https://imagem.com" type="text" name="imagem"
        id="imagem">

      <label for="preco">Preço:</label>
      <input class="bg-zinc-100 p-2 border border-zinc-300" placeholder="99999" type="text" name="preco" id="preco">

      <label for="desc">Descrição:</label>
      <input class="bg-zinc-100 p-2 border border-zinc-300" placeholder="Este produto inovou o mercado..." type="text"
        name="desc" id="desc">

      <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
        Alterar Produto
      </button>
    </form>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    </div>
  </main>
</body>

</html>