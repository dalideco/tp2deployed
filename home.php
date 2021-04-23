<?php
include_once 'fragments/header.php';
include_once 'isAuthenticated.php';
$pageTitle = 'home';
include_once 'classes/PersonneRepository.php';
$Repo=new PersonneRepository();
$personnes=$Repo->findAll();
?>

<style>
    .change-my-color{
        padding: 20px 5px;
        transition:background 300ms ease-in-out;
        border-radius: 3px;
    }
    .change-my-color:hover{
        
        background:rgba(0,0,0,0.3);
        /* -webkit-box-shadow: 5px 5px 15px 5px rgba(0,0,0,0.28); 
        box-shadow: 5px 5px 15px 5px rgba(0,0,0,0.28); */
    }
</style>

<div class="alert alert-success">
    Welcome <?php echo $_SESSION['user']; ?>
</div>

<table class="table table-striped table-Info Info">
<tr>
    <th>id</th>
    <th>email</th>
    <th>password</th>
    <th>Admin </th>
    <td>Image</td>
    <th>Delete</th>
    <th>Modify</th>
</tr>
    <?php foreach($personnes as $personne){?>
    <tr>
        <td><?= $personne->id ?></td>
        <td><?= $personne->mail ?></td>
        <td><?= $personne->password ?></td> 
        <td>
            <?php if($personne->isadmin==1){?>
                yes
            <?php }else{?>
                no
            <?php } ?>
        </td>   
        <td><img style="width: 100px;height:100px;object-fit:cover; border-radius:50%" src="pictures/<?= $personne->image?>"></img></td>
        <td>
        <span>
            <a href="delete.php?id=<?= $personne->id ?>"> 
            <span class="change-my-color">
                <img src="delete.svg" width="40" height="40"  />
            </span>
            </a>
         </span>
         </td>
        <td>
        <span>
        <a href="profile.php?id=<?=$personne->id ?>">
            <span class="change-my-color">
                <img src="modify.svg" width="40" height="40"  />
            </span>
        </a>
        </span>
        </td>

    </tr>
    <?php
    }
    ?>
    <tr>
        <form enctype="multipart/form-data" action="add.php" method="post">
            <td>New Person</td>
            <td><input type="text" name="mail"></td>
            <td><input type="password" name="password"></td>
            <td><input type="text" name="isAdmin"></td>
            <td><input type="file" name="image"></td>
            <td><button type="submit">Submit</button></td>
            
        </form> 
    </tr>
</table>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script>
    const homeBut = document.querySelector('#homeBut');
    const logsBut = document.querySelector('#logsBut')
    if(logsBut.classList.contains("active"))
        logsBut.classList.remove("active");
    if(!(homeBut.classList.contains("active")))
        homeBut.classList.add("active");
</script>
</body>
</html>
