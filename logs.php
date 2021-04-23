<?php
    include_once 'fragments/header.php';
    // $fp=fopen('data.txt','r');


    // $filename = 'info.txt';
    // $contents = file($filename);

    // foreach($contents as $line) {
    //     echo $line . "\n";
    // } 
 ?>

<div>

    <table class="table table-striped table-Info Info">
        <thead>
            <th>
                Date
            </th>
            <th>
                Done by 
            </th>
            <th>
                Description
            </th>
        </thead>
        <tbody>
            <?php 
                $filename = 'data.txt';
                $contents = file($filename);
                
                foreach($contents as $line) {
                    $tab = explode('--',$line);
            ?>
            <tr>
            <?php
                    foreach($tab as $element){
            ?>
                    <td>
                        <?= $element ?>
                    </td>
            <?php }} ?>
            </tr>
        </tbody>
    </table>

    <script>
        const homeBut = document.querySelector('#homeBut');
        const logsBut = document.querySelector('#logsBut')
        if(homeBut.classList.contains("active"))
            homeBut.classList.remove("active");
        if(!(logsBut.classList.contains("active")))
            logsBut.classList.add("active");
    </script>
    
</div>
<script>
    const homeBut = document.querySelector('#homeBut');
    const logsBut = document.querySelector('#logsBut')
    if(homeBut.classList.contains("active"))
        homeBut.classList.remove("active");
    if(!(logsBut.classList.contains("active")))
        logsBut.classList.add("active");
</script>
</body>
</html>