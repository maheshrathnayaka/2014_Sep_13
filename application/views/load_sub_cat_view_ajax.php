<div class="form-group" id="nextSubLevel">
    <label for="txtCatName" class="col-sm-3 control-label">Sub Category </label>
    <div class="col-sm-6" id="divCategorySub">
        <select class="form-control" id="selectCategorySub">
            <option value = "Select sub category">Select sub category</option>
            <?php
            foreach ($sub_category as $sub_cat) {
                ?>
                <option value = "<?php echo $sub_cat['categoryname']; ?>"><?php echo $sub_cat['categoryname']; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
</div>