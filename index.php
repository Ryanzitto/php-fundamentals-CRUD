<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
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
    <h1 class="text-3xl font-bold mb-4">CATALOGO</h1>
    <div class="flex gap-4 flex-wrap justify-center">
      <?php 
      include "db.php";
        $sql = "SELECT * FROM produto";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            echo "<p class='text-red-500'>Não foi possível preparar a conexão</p>";
        } else {
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
              echo "<div class='w-[400px] p-6 border rounded-lg shadow-lg'>";
              echo "<img src='" . htmlspecialchars($row['imagem']) . "' class='w-full h-auto mb-4'>";
              echo "<h2 class='text-xl font-bold'>" . htmlspecialchars($row['nome']) . "</h2>";
              echo "<p class='pt-2 text-md text-gray-700'>" . htmlspecialchars($row['descricao']) . "</p>";
              echo "<p class='pt-2 text-lg text-green-600 font-bold'>R$ " . number_format($row['preco'], 2, ',', '.') . "</p>";
              echo "<div class='pt-2 flex justify-center items-center gap-4'>";
              echo "<a href='update.php?id=" . $row['id'] . "' class='p-2 px-6 bg-yellow-500 rounded-md cursor-pointer hover:bg-yellow-400 transition-all text-white'>update</a>";
              echo "<a href='delete.php?id=" . $row['id'] . "' class='p-2 px-6 bg-red-500 rounded-md cursor-pointer hover:bg-red-400 transition-all text-white'>delete</a>";
              echo "</div>";
              echo "</div>";
          }
          

            $stmt->close();
        }
      ?>
    </div>
  </main>
</body>

</html>