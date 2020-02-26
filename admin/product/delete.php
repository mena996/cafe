    <?php
function check(){
    include '../../datbaseFiles/databaseConfig.php';

        $stmt = $db->prepare("DELETE FROM products WHERE product_id=?");
        $stmt->execute([$_GET["id"]]);
}
check();
?> 