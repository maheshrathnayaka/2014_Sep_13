<div class="form-group" id="subLevel">
    <label for="selectCategoryType" class="col-sm-3 control-label">Category </label>
    <div class="col-sm-6" id="divCategoryMain">
        <select class="form-control" id="selectCategoryMain">
            <option value = "Select category">Select category</option>
            <?php
            foreach ($category as $cat) {
                ?>
                <option value = "<?php echo $cat['categoryname']; ?>"><?php echo $cat['categoryname']; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="col-sm-offset-3 col-sm-10">
        <button type="button" class="btn btn-default" style="margin-top: 2px;" onclick="get_sub_category();">Sub level</button>
    </div>
</div>
