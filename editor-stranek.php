
<form action="" method="post">
<label for="motyl">Obsah stranky: </label>
<textarea name="obsah-stranky" id="motyl" cols="30" rows="10"><?php echo htmlspecialchars( $aktivniInstance->getObsah());?></textarea>
<input type="submit" name="aktualizovat-submit" value="Aktualizovat web">
</form>
