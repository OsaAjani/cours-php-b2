<?php
    $products = [
        ['id' => 1, 'name' => 'Filament 3D PLA - 500g', 'price' => 10.33, 'desc' => '...'],
        ['id' => 2, 'name' => 'Filament 3D ABS - 500g', 'price' => 15.00, 'desc' => '...'],
        ['id' => 3, 'name' => 'Filament 3D PETG - 500g', 'price' => 12.19, 'desc' => '...'],
    ];
?>
<h1>Nos filaments 3D</h1>
<ul>
    <?php
        foreach ($products as $product)
        {
        ?>
        <li><a href="/fiche_produit.php?id=<?php echo $product['id']; ?>"><?php echo $product['name'] . ' - ' . $product['price'] . '€'; ?></a></li>
        <?php
        }
    ?>
</ul>