<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Delete</title>
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

  <?php 
  include "db.php";
  if($_SERVER["REQUEST_METHOD"] == "POST"){
  $id = $_GET["id"];
  $sql = "DELETE FROM produto WHERE id = ?";

  $stmt = $conn->prepare($sql);

  if($stmt){
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo "produto apagado com sucesso!";
    $stmt->close();
    }
  } else { 
    echo "deu ruim";

  }
  



  ?>
  <main class="w-full p-10 flex flex-col items-center gap-20">

    <a class="underline text-zinc-500 hover:text-zinc-400" href="index.php">
      Go to home
    </a>

    <h1 class="text-3xl text-red-500 font-bold mb-4">Are you sure about delete this product?</h1>
    <div class="flex">

      <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $_GET['id']; ?>" method="POST"
        class="flex w-[500px] flex justify-center gap-4">
        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-8 rounded">
          Yes
        </button>
      </form>
    </div>
  </main>
</body>

</html>