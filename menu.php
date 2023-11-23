<div class="menu">
    <ul>
        <?php
          foreach ($poleStranek as $stranka) {
            // echo "<li><a href='?id-stranky={$stranka['id']}'>{$stranka['menu']}</a></li>"; misto tohoto to dole
            echo "<li><a href='?id-stranky={$stranka->getId()}'>{$stranka->getMenu()}</a></li>";
          }
        ?>
    </ul> 
</div>
