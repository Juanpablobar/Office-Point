<?php
if(isset($_POST["id"])){
include './conexion.php'; 
include '../layouts/icons.php'; 

$lastid = $_POST['id'];

$showLimit = 100;

//Get all rows except already displayed
$queryAll = $conexion->query("SELECT COUNT(*) as num_rows FROM productos WHERE id > ".$lastid." ORDER BY id ASC");
$filaAll = $queryAll->fetch_assoc();
$allNumRows = $filaAll['num_rows'];

//Get rows by limit except already displayed
$query = $conexion->query("SELECT * FROM productos WHERE id > ".$lastid." ORDER BY id ASC LIMIT ".$showLimit);

if($query->num_rows > 0){
    while($fila = $query->fetch_assoc()){ 
        $postID = $fila["id"];
		 ?>
		<div class="item-shop">
			<div class="item-shop-cont">
			<div class="item-shop-prev">
					<div class="item-shop-img">
						<img src="img/<?php echo $fila['img']; ?>">
						<div class="item-shop-hide">
							<div class="item-shop-hide-top">
								<div class="item-shop-hide-a"><a href="wishlist?id=<?php echo $fila['id']; ?>" title="Agregar a la lista de deseos"><?php echo $heart; ?></a></div>
								<div class="item-shop-hide-a"><a href="#" title="Buscar productos similares"><?php echo $loupe; ?></a></div>
							</div>
							<div class="item-shop-hide-bottom">
								<div class="item-shop-hide-a"><a href="cart?id=<?php echo $fila['id']; ?>&cant=1" title="Agregar al carrito"><?php echo $bag; ?></a></div>
							</div>
						</div>
						<?php
                        if ($fila['nuevo'] == 'si') {
                            echo '<div class="item-shop-new">
							<span>New</span>
						</div>';
                        } else {
                            echo '';
                        }
                    
                           if ($fila['descuento'] > 0) {
                               echo '<div class="item-shop-discounts">
							<span>-'.$fila['descuento'].'%</span>
						</div>';
                           } else {
                               echo '';
                           } ?>
					</div>
					<div class="item-shop-text-list">
					<a href="shop-single?id=<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></a>
					<h3><?php echo substr($fila['descripcion'],0,100); ?>...</h3>
					</div>
					<div class="item-shop-text">
						<a href="shop-single?id=<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></a>
						<?php
                                $percent = round($fila['descuento']/100*$fila['precio']);
                           if ($fila['descuento'] > 0) {
                               echo '<h2 class="item-shop-h2-first">$'.$fila['precio'].'.00</h2>';
                               echo '<h2 class="item-shop-h2-second	" style="color:#ff6363">$'.($fila['precio'] - $percent).'.00</h2>';
                           } else {
                               echo '<h2>$'.$fila['precio'].'.00</h2>';
                           } ?>
					</div>
				</div>
			</div>
		</div>
          <?php } ?>
<?php if($allNumRows > $showLimit){ ?>
	<div class="shop-button-charge">
            <button type="button" class="load-more" data-lastid="<?php echo $postID; ?>"><i class="fa fa-spinner"></i> CARGAR MÁS
               </button>
			   </div>
<?php }else{ ?>
    <div class="shop-button-charge" style="display: none;">
            <button class="load-more" data-lastid="0">Cargar Más
               </button>
			   </div>
<?php }
    }else{ ?>
               <div class="shop-button-charge" style="display: none;">
            <button class="load-more" data-lastid="0">Cargar Más
               </button>
			   </div>

<?php
    }
}
?>