<div id="div_city">
    <label for="loctype" class="control-label">City:</label>
    <select class="form-control" id="locname" onChange="refresh_wo_location()">
        <option value="0">Any</option>
        <?php
        if (isset($loc) && !empty($loc)) {
            foreach ($loc as $city) {
                ?>
                <option><?php echo $city['city'] ?></option>       
                <?php
            }
        }
        ?>
    </select>
</div>