<?php 

    include_once 'classes/PersonneRepository.php';
    $repo = new PersonneRepository();
    $id = $_GET['id'];
    $information = $repo->findById($id);
    include_once 'fragments/header.php'
    
?>

<div class="container mt-5 d-flex justify-content-center">
    <div class="card p-3">
        <div class="d-flex align-items-center">
            <div class="image">
                 <img src="pictures/<?=$information->image?>" class="rounded" width="155"> 
                 
            </div>
            <div class="ml-3 w-100">
                <form enctype="multipart/form-data" action="modify.php" method="post">
                  
                    <input type="text" name="id"  value="<?=$information->id ?>" disabled >
                    <input type="hidden" name="id"  value="<?=$information->id ?>" >
                    <input name="mail" value="<?=$information->mail?>">
                    <input name="password" value="<?=$information->password?>">
                    <input name="isAdmin" 
                        value="<?php if($information->isadmin==1){?>1<?php }else{?>0<?php } ?>" 
                        placeholder="1 if admin, 0 if not.">
                    <input type="file" name="image" >
                    <input type="hidden" name="oldImage" value="<?=$information->image?>">
                    <div class="button mt-2 d-flex flex-row align-items-center">
                        <button type="submit" >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>

