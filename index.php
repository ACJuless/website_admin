<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<style>
   .dropdown:hover .dropdown-menu {
    display: block;
   }
   .selected {
    border: 2px solid black;
   }
</style>

<script>
   function showAddUserForm() {
    document.getElementById('addUserForm').classList.remove('hidden');
   }

   function hideAddUserForm() {
    document.getElementById('addUserForm').classList.add('hidden');
   }

   function showRemoveUserForm() {
    const rows = document.querySelectorAll('#userTableBody tr');
    // rows.forEach(row => {
    //   const checkbox = document.createElement('input');
    //   checkbox.type = 'checkbox'; 
    //   checkbox.classList.add('remove-checkbox', 'form-checkbox', 'h-5', 'w-5', 'text-red-600');
    //   row.insertCell(3).appendChild(checkbox);
    // });
    document.getElementById('removeUserForm').classList.remove('hidden');
   }

   function hideRemoveUserForm() {
    const checkboxes = document.querySelectorAll('.remove-checkbox');
    checkboxes.forEach(checkbox => {
     checkbox.parentElement.remove();
    });
    document.getElementById('removeUserForm').classList.add('hidden');
   }

   function removeUsers() {
    const checkboxes = document.querySelectorAll('.remove-checkbox:checked');
    checkboxes.foreach(checkbox => {
     checkbox.closest('tr').remove();
    });
    hideRemoveUserForm();
   }

   function showEditUserForm() {
    const rows = document.querySelectorAll('#userTableBody tr');
    rows.forEach(row => {
     const radio = document.createElement('input');
     radio.type = 'radio';
     radio.name = 'edit-radio';
     radio.classList.add('edit-radio', 'form-radio', 'h-5', 'w-5', 'text-blue-600',);
     row.insertCell(3).appendChild(radio);
    });
    document.getElementById('editUserForm').classList.remove('hidden');
   }

   function hideEditUserForm() {
    const radios = document.querySelectorAll('.edit-radio');
    radios.forEach(radio => {
     radio.parentElement.remove();
    });
    document.getElementById('editUserForm').classList.add('hidden');
   }

   function editUser() {
    const selectedRadio = document.querySelector('.edit-radio:checked');
    if (selectedRadio) {
     const row = selectedRadio.closest('tr');
     const username = prompt("Enter Full Name", row.cells[2].innerText);
     const email = prompt("Enter Email", row.cells[3].innerText);
     const branch = prompt("Enter Branch", row.cells[4].innerText);
     const role = prompt("Enter Role", row.cells[5].innerText);
     const createdOn = prompt("Enter Created On", row.cells[6].innerText);
     const createdBy = prompt("Enter Created By", row.cells[7].innerText);

     if (username && email && branch && role && createdOn && createdBy) {
      row.cells[2].innerText = username;
      row.cells[3].innerText = email;
      row.cells[4].innerText = branch;
      row.cells[5].innerText = role;
      row.cells[6].innerText = createdOn;
      row.cells[7].innerText = createdBy;

      hideEditUserForm();
     }
    }
   }

   function showMedCatalog() {
    document.getElementById('userPage').classList.add('hidden');
    document.getElementById('medCatalogPage').classList.remove('hidden');
    document.getElementById('inventoryPage').classList.add('hidden');
    // document.getElementById('transactionsPage').classList.add('hidden');
    document.getElementById('usersButton').classList.remove('selected');
    document.getElementById('medCatalogButton').classList.add('selected');
    document.getElementById('inventoryButton').classList.remove('selected');
    document.getElementById('transactionsButton').classList.remove('selected');
   }

   function showUsers() {
    document.getElementById('medCatalogPage').classList.add('hidden');
    document.getElementById('userPage').classList.remove('hidden');
    document.getElementById('inventoryPage').classList.add('hidden');
    // document.getElementById('transactionsPage').classList.add('hidden');
    document.getElementById('usersButton').classList.add('selected');
    document.getElementById('medCatalogButton').classList.remove('selected');
    document.getElementById('inventoryButton').classList.remove('selected');
    document.getElementById('transactionsButton').classList.remove('selected');
   }

   function showInventory() {
    document.getElementById('userPage').classList.add('hidden');
    document.getElementById('medCatalogPage').classList.add('hidden');
    document.getElementById('inventoryPage').classList.remove('hidden');
    // document.getElementById('transactionsPage').classList.add('hidden');
    document.getElementById('usersButton').classList.remove('selected');
    document.getElementById('medCatalogButton').classList.remove('selected');
    document.getElementById('inventoryButton').classList.add('selected');
    document.getElementById('transactionsButton').classList.remove('selected');
   }

   function showTransactions() {
    document.getElementById('userPage').classList.add('hidden');
    document.getElementById('medCatalogPage').classList.add('hidden');
    document.getElementById('inventoryPage').classList.add('hidden');
    // document.getElementById('transactionsPage').classList.remove('hidden');
    document.getElementById('usersButton').classList.remove('selected');
    document.getElementById('medCatalogButton').classList.remove('selected');
    document.getElementById('inventoryButton').classList.remove('selected');
    document.getElementById('transactionsButton').classList.add('selected');
   }
  </script>

<body>
<?php
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);
?>

<div class="header">
	<h2>Dashboard</h2>
</div>

<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>

<body class="bg-gray-100">
  <div class="flex items-center justify-between p-4 bg-white shadow">
   <div class="flex items-center">
    <img alt="User profile picture" class="rounded-full" height="40" src="https://storage.googleapis.com/a1aa/image/sxf1h605GKQ1fUWkSLeB31Sbzc3f4wOgdl9seHX7keCXrEA6E.jpg" width="40"/>
    <span class="ml-2">
    <!-- <strong><?php echo $_SESSION['username']; ?></strong>    </span> -->
    <i class="fas fa-caret-down ml-2">
    </i>
   </div>
   <div class="flex space-x-4">
    <button class="px-4 py-2 selected" id="usersButton" onclick="showUsers()">
     Users
    </button>
    <button class="px-4 py-2" id="medCatalogButton" onclick="showMedCatalog()">
     Med Catalog
    </button>
    <button class="px-4 py-2" id="inventoryButton" onclick="showInventory()">
     Inventory
    </button>
    <!-- <button class="px-4 py-2" id="transactionsButton" onclick="showTransactions()">
     Transactions
    </button> -->
   </div>
  </div>
<div class="p-4" id="userPage">
    <div class="bg-white shadow rounded-lg p-4">
        <div class="dropdown relative mb-4">
        <i class="fas fa-ellipsis-v cursor-pointer">
        </i>
<a href="add.php"><button>Add User</button></a>
<table class="w-full" border="1" width="500">
    <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th colspan="2">Action</th>
    </tr>
    </thead>
    <tbody id="userTableBody">
      <!-- Display the Admins' info -->
    <?php
    $data = $db->retrieve("users");
    $data = json_decode($data, 1);

    if(is_array($data)){
        foreach($data as $id => $users){
            echo "<tr>
            <td>{$users['id_no']}</td>
            <td>{$users['username']}</td>
            <td>{$users['email']}</td>
            <td><a href='edit.php?id=$id'>Edit</a></td>
            <td><a href='delete.php?id=$id'>Delete</a></td>
            </tr>";
        }
    }
    ?>
    </tbody>
</table>

        </div>
    </div>
</div>

<!-- MED CATALOG -->

<div class="p-4 hidden" id="medCatalogPage">
   <div class="bg-white shadow rounded-lg p-4">
    <div class="dropdown relative mb-4">
     <i class="fas fa-ellipsis-v cursor-pointer">
     </i>
     <div class="dropdown-menu absolute hidden text-gray-700 pt-1">
      <table class="bg-white shadow rounded-lg">
       </table>
       </div>
       </div>
       <table class="w-full">
        <thead>
         <tr>
          <th class="py-2">
           Photo
          </th>
          <th class="py-2">
           Generic Name
          </th>
          <th class="py-2">
           Brand Name
          </th>
          <th class="py-2">
           Quality
          </th>
          <th class="py-2">
           Expiry
          </th>
          <th class="py-2">
           Description
          </th>
         </tr>
        </thead>
        <tbody id="userTableBody">
            <tr class="border-t">
             <td class="py-2">
              <img alt="User profile picture" class="rounded-full" height="40" src="https://storage.googleapis.com/a1aa/image/sxf1h605GKQ1fUWkSLeB31Sbzc3f4wOgdl9seHX7keCXrEA6E.jpg" width="40"/>
             </td>
             <td class="py-2">
              Enervoon
             </td>
             <td class="py-2">
              Enervon
             </td>
             <td class="py-2">
              Good
             </td>
             <td class="py-2">
              9 Months
             </td>
             <td class="py-2">
              Use Responsibly
             </td>
            </tr>
        </table>
       </div>
       </div>
       </div>

       
<!-- INVENTORY -->

<div class="p-4 hidden" id="inventoryPage">
    <div class="bg-white shadow rounded-lg p-4">
     <div class="dropdown relative mb-4">
      <i class="fas fa-ellipsis-v cursor-pointer">
      </i>
      <div class="dropdown-menu absolute hidden text-gray-700 pt-1">
       <table class="bg-white shadow rounded-lg">
        </table>
        </div>
        </div>
        <table class="w-full">
         <thead>
          <tr>
           <th class="py-2">
            ID
           </th>
           <th class="py-2">
            Type of Medicine
           </th>
           <th class="py-2">
            Brand Name
           </th>
           <th class="py-2">
            Quantity
           </th>
           <th class="py-2">
            Expiration
           </th>
           <th class="py-2">
            Expires On
           </th>
          </tr>
         </thead>
         <tbody id="userTableBody">
            <tr class="border-t">
             <td class="py-2">
              2024123456
            </td>
             <td class="py-2">
              Vitamins
             </td>
             <td class="py-2">
              Enervon
             </td>
             <td class="py-2">
              Good
             </td>
             <td class="py-2">
              9 Months
             </td>
             <td class="py-2">
              Febuary 2026
             </td>
            </tr>
        </div>
        </div>
</div>

<a href = "login.php"><button>Logout</button></a>

</body>
</html>