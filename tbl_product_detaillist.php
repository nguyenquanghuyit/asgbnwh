<?php
namespace PHPMaker2019\asgbn_wh;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$tbl_product_detail_list = new tbl_product_detail_list();

// Run the page
$tbl_product_detail_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_product_detail_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_product_detail->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_product_detaillist = currentForm = new ew.Form("ftbl_product_detaillist", "list");
ftbl_product_detaillist.formKeyCountName = '<?php echo $tbl_product_detail_list->FormKeyCountName ?>';

// Validate form
ftbl_product_detaillist.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($tbl_product_detail_list->PackingQty->Required) { ?>
			elm = this.getElements("x" + infix + "_PackingQty");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product_detail->PackingQty->caption(), $tbl_product_detail->PackingQty->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PackingQty");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_product_detail->PackingQty->errorMessage()) ?>");
		<?php if ($tbl_product_detail_list->IdUnit->Required) { ?>
			elm = this.getElements("x" + infix + "_IdUnit");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product_detail->IdUnit->caption(), $tbl_product_detail->IdUnit->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_detail_list->DefaultCode->Required) { ?>
			elm = this.getElements("x" + infix + "_DefaultCode");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product_detail->DefaultCode->caption(), $tbl_product_detail->DefaultCode->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftbl_product_detaillist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_product_detaillist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_product_detaillist.lists["x_IdUnit"] = <?php echo $tbl_product_detail_list->IdUnit->Lookup->toClientList() ?>;
ftbl_product_detaillist.lists["x_IdUnit"].options = <?php echo JsonEncode($tbl_product_detail_list->IdUnit->lookupOptions()) ?>;
ftbl_product_detaillist.lists["x_DefaultCode"] = <?php echo $tbl_product_detail_list->DefaultCode->Lookup->toClientList() ?>;
ftbl_product_detaillist.lists["x_DefaultCode"].options = <?php echo JsonEncode($tbl_product_detail_list->DefaultCode->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script src="phpjs/ewpreview.js"></script>
<script>
ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "left" : "right";
ew.PREVIEW_SINGLE_ROW = false;
ew.PREVIEW_OVERLAY = false;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_product_detail->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_product_detail_list->TotalRecs > 0 && $tbl_product_detail_list->ExportOptions->visible()) { ?>
<?php $tbl_product_detail_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_product_detail_list->ImportOptions->visible()) { ?>
<?php $tbl_product_detail_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$tbl_product_detail->isExport() || EXPORT_MASTER_RECORD && $tbl_product_detail->isExport("print")) { ?>
<?php
if ($tbl_product_detail_list->DbMasterFilter <> "" && $tbl_product_detail->getCurrentMasterTable() == "tbl_product") {
	if ($tbl_product_detail_list->MasterRecordExists) {
		include_once "tbl_productmaster.php";
	}
}
?>
<?php } ?>
<?php
$tbl_product_detail_list->renderOtherOptions();
?>
<?php $tbl_product_detail_list->showPageHeader(); ?>
<?php
$tbl_product_detail_list->showMessage();
?>
<?php if ($tbl_product_detail_list->TotalRecs > 0 || $tbl_product_detail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_product_detail_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_product_detail">
<?php if (!$tbl_product_detail->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_product_detail->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_product_detail_list->Pager)) $tbl_product_detail_list->Pager = new PrevNextPager($tbl_product_detail_list->StartRec, $tbl_product_detail_list->DisplayRecs, $tbl_product_detail_list->TotalRecs, $tbl_product_detail_list->AutoHidePager) ?>
<?php if ($tbl_product_detail_list->Pager->RecordCount > 0 && $tbl_product_detail_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_product_detail_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_product_detail_list->pageUrl() ?>start=<?php echo $tbl_product_detail_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_product_detail_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_product_detail_list->pageUrl() ?>start=<?php echo $tbl_product_detail_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_product_detail_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_product_detail_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_product_detail_list->pageUrl() ?>start=<?php echo $tbl_product_detail_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_product_detail_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_product_detail_list->pageUrl() ?>start=<?php echo $tbl_product_detail_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_product_detail_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_product_detail_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_product_detail_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_product_detail_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_product_detail_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_product_detail_list->TotalRecs > 0 && (!$tbl_product_detail_list->AutoHidePageSizeSelector || $tbl_product_detail_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_product_detail">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_product_detail_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_product_detail_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_product_detail_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_product_detail_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_product_detail_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_product_detail->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_product_detail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_product_detaillist" id="ftbl_product_detaillist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_product_detail_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_product_detail_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_product_detail">
<input type="hidden" name="exporttype" id="exporttype" value="">
<?php if ($tbl_product_detail->getCurrentMasterTable() == "tbl_product" && $tbl_product_detail->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="tbl_product">
<input type="hidden" name="fk_Code" value="<?php echo $tbl_product_detail->CODE->getSessionValue() ?>">
<?php } ?>
<div id="gmp_tbl_product_detail" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_product_detail_list->TotalRecs > 0 || $tbl_product_detail->isAdd() || $tbl_product_detail->isCopy() || $tbl_product_detail->isGridEdit()) { ?>
<table id="tbl_tbl_product_detaillist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_product_detail_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_product_detail_list->renderListOptions();

// Render list options (header, left)
$tbl_product_detail_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_product_detail->PackingQty->Visible) { // PackingQty ?>
	<?php if ($tbl_product_detail->sortUrl($tbl_product_detail->PackingQty) == "") { ?>
		<th data-name="PackingQty" class="<?php echo $tbl_product_detail->PackingQty->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_product_detail_PackingQty" class="tbl_product_detail_PackingQty"><div class="ew-table-header-caption"><?php echo $tbl_product_detail->PackingQty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PackingQty" class="<?php echo $tbl_product_detail->PackingQty->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_product_detail->SortUrl($tbl_product_detail->PackingQty) ?>',2);"><div id="elh_tbl_product_detail_PackingQty" class="tbl_product_detail_PackingQty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_product_detail->PackingQty->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_product_detail->PackingQty->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_product_detail->PackingQty->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product_detail->IdUnit->Visible) { // IdUnit ?>
	<?php if ($tbl_product_detail->sortUrl($tbl_product_detail->IdUnit) == "") { ?>
		<th data-name="IdUnit" class="<?php echo $tbl_product_detail->IdUnit->headerCellClass() ?>"><div id="elh_tbl_product_detail_IdUnit" class="tbl_product_detail_IdUnit"><div class="ew-table-header-caption"><?php echo $tbl_product_detail->IdUnit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IdUnit" class="<?php echo $tbl_product_detail->IdUnit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_product_detail->SortUrl($tbl_product_detail->IdUnit) ?>',2);"><div id="elh_tbl_product_detail_IdUnit" class="tbl_product_detail_IdUnit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_product_detail->IdUnit->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_product_detail->IdUnit->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_product_detail->IdUnit->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product_detail->DefaultCode->Visible) { // DefaultCode ?>
	<?php if ($tbl_product_detail->sortUrl($tbl_product_detail->DefaultCode) == "") { ?>
		<th data-name="DefaultCode" class="<?php echo $tbl_product_detail->DefaultCode->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_product_detail_DefaultCode" class="tbl_product_detail_DefaultCode"><div class="ew-table-header-caption"><?php echo $tbl_product_detail->DefaultCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DefaultCode" class="<?php echo $tbl_product_detail->DefaultCode->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_product_detail->SortUrl($tbl_product_detail->DefaultCode) ?>',2);"><div id="elh_tbl_product_detail_DefaultCode" class="tbl_product_detail_DefaultCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_product_detail->DefaultCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_product_detail->DefaultCode->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_product_detail->DefaultCode->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_product_detail_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($tbl_product_detail->isAdd() || $tbl_product_detail->isCopy()) {
		$tbl_product_detail_list->RowIndex = 0;
		$tbl_product_detail_list->KeyCount = $tbl_product_detail_list->RowIndex;
		if ($tbl_product_detail->isAdd())
			$tbl_product_detail_list->loadRowValues();
		if ($tbl_product_detail->EventCancelled) // Insert failed
			$tbl_product_detail_list->restoreFormValues(); // Restore form values

		// Set row properties
		$tbl_product_detail->resetAttributes();
		$tbl_product_detail->RowAttrs = array_merge($tbl_product_detail->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_tbl_product_detail', 'data-rowtype'=>ROWTYPE_ADD));
		$tbl_product_detail->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_product_detail_list->renderRow();

		// Render list options
		$tbl_product_detail_list->renderListOptions();
		$tbl_product_detail_list->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_product_detail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_product_detail_list->ListOptions->render("body", "left", $tbl_product_detail_list->RowCnt);
?>
	<?php if ($tbl_product_detail->PackingQty->Visible) { // PackingQty ?>
		<td data-name="PackingQty">
<span id="el<?php echo $tbl_product_detail_list->RowCnt ?>_tbl_product_detail_PackingQty" class="form-group tbl_product_detail_PackingQty">
<input type="text" data-table="tbl_product_detail" data-field="x_PackingQty" name="x<?php echo $tbl_product_detail_list->RowIndex ?>_PackingQty" id="x<?php echo $tbl_product_detail_list->RowIndex ?>_PackingQty" size="5" placeholder="<?php echo HtmlEncode($tbl_product_detail->PackingQty->getPlaceHolder()) ?>" value="<?php echo $tbl_product_detail->PackingQty->EditValue ?>"<?php echo $tbl_product_detail->PackingQty->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product_detail" data-field="x_PackingQty" name="o<?php echo $tbl_product_detail_list->RowIndex ?>_PackingQty" id="o<?php echo $tbl_product_detail_list->RowIndex ?>_PackingQty" value="<?php echo HtmlEncode($tbl_product_detail->PackingQty->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_product_detail->IdUnit->Visible) { // IdUnit ?>
		<td data-name="IdUnit">
<span id="el<?php echo $tbl_product_detail_list->RowCnt ?>_tbl_product_detail_IdUnit" class="form-group tbl_product_detail_IdUnit">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_product_detail" data-field="x_IdUnit" data-value-separator="<?php echo $tbl_product_detail->IdUnit->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_product_detail_list->RowIndex ?>_IdUnit" name="x<?php echo $tbl_product_detail_list->RowIndex ?>_IdUnit"<?php echo $tbl_product_detail->IdUnit->editAttributes() ?>>
		<?php echo $tbl_product_detail->IdUnit->selectOptionListHtml("x<?php echo $tbl_product_detail_list->RowIndex ?>_IdUnit") ?>
	</select>
</div>
<?php echo $tbl_product_detail->IdUnit->Lookup->getParamTag("p_x" . $tbl_product_detail_list->RowIndex . "_IdUnit") ?>
</span>
<input type="hidden" data-table="tbl_product_detail" data-field="x_IdUnit" name="o<?php echo $tbl_product_detail_list->RowIndex ?>_IdUnit" id="o<?php echo $tbl_product_detail_list->RowIndex ?>_IdUnit" value="<?php echo HtmlEncode($tbl_product_detail->IdUnit->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_product_detail->DefaultCode->Visible) { // DefaultCode ?>
		<td data-name="DefaultCode">
<span id="el<?php echo $tbl_product_detail_list->RowCnt ?>_tbl_product_detail_DefaultCode" class="form-group tbl_product_detail_DefaultCode">
<div id="tp_x<?php echo $tbl_product_detail_list->RowIndex ?>_DefaultCode" class="ew-template"><input type="radio" class="form-check-input" data-table="tbl_product_detail" data-field="x_DefaultCode" data-value-separator="<?php echo $tbl_product_detail->DefaultCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_product_detail_list->RowIndex ?>_DefaultCode" id="x<?php echo $tbl_product_detail_list->RowIndex ?>_DefaultCode" value="{value}"<?php echo $tbl_product_detail->DefaultCode->editAttributes() ?>></div>
<div id="dsl_x<?php echo $tbl_product_detail_list->RowIndex ?>_DefaultCode" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $tbl_product_detail->DefaultCode->radioButtonListHtml(FALSE, "x{$tbl_product_detail_list->RowIndex}_DefaultCode") ?>
</div></div>
</span>
<input type="hidden" data-table="tbl_product_detail" data-field="x_DefaultCode" name="o<?php echo $tbl_product_detail_list->RowIndex ?>_DefaultCode" id="o<?php echo $tbl_product_detail_list->RowIndex ?>_DefaultCode" value="<?php echo HtmlEncode($tbl_product_detail->DefaultCode->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_product_detail_list->ListOptions->render("body", "right", $tbl_product_detail_list->RowCnt);
?>
<script>
ftbl_product_detaillist.updateLists(<?php echo $tbl_product_detail_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($tbl_product_detail->ExportAll && $tbl_product_detail->isExport()) {
	$tbl_product_detail_list->StopRec = $tbl_product_detail_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_product_detail_list->TotalRecs > $tbl_product_detail_list->StartRec + $tbl_product_detail_list->DisplayRecs - 1)
		$tbl_product_detail_list->StopRec = $tbl_product_detail_list->StartRec + $tbl_product_detail_list->DisplayRecs - 1;
	else
		$tbl_product_detail_list->StopRec = $tbl_product_detail_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $tbl_product_detail_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_product_detail_list->FormKeyCountName) && ($tbl_product_detail->isGridAdd() || $tbl_product_detail->isGridEdit() || $tbl_product_detail->isConfirm())) {
		$tbl_product_detail_list->KeyCount = $CurrentForm->getValue($tbl_product_detail_list->FormKeyCountName);
		$tbl_product_detail_list->StopRec = $tbl_product_detail_list->StartRec + $tbl_product_detail_list->KeyCount - 1;
	}
}
$tbl_product_detail_list->RecCnt = $tbl_product_detail_list->StartRec - 1;
if ($tbl_product_detail_list->Recordset && !$tbl_product_detail_list->Recordset->EOF) {
	$tbl_product_detail_list->Recordset->moveFirst();
	$selectLimit = $tbl_product_detail_list->UseSelectLimit;
	if (!$selectLimit && $tbl_product_detail_list->StartRec > 1)
		$tbl_product_detail_list->Recordset->move($tbl_product_detail_list->StartRec - 1);
} elseif (!$tbl_product_detail->AllowAddDeleteRow && $tbl_product_detail_list->StopRec == 0) {
	$tbl_product_detail_list->StopRec = $tbl_product_detail->GridAddRowCount;
}

// Initialize aggregate
$tbl_product_detail->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_product_detail->resetAttributes();
$tbl_product_detail_list->renderRow();
$tbl_product_detail_list->EditRowCnt = 0;
if ($tbl_product_detail->isEdit())
	$tbl_product_detail_list->RowIndex = 1;
while ($tbl_product_detail_list->RecCnt < $tbl_product_detail_list->StopRec) {
	$tbl_product_detail_list->RecCnt++;
	if ($tbl_product_detail_list->RecCnt >= $tbl_product_detail_list->StartRec) {
		$tbl_product_detail_list->RowCnt++;

		// Set up key count
		$tbl_product_detail_list->KeyCount = $tbl_product_detail_list->RowIndex;

		// Init row class and style
		$tbl_product_detail->resetAttributes();
		$tbl_product_detail->CssClass = "";
		if ($tbl_product_detail->isGridAdd()) {
			$tbl_product_detail_list->loadRowValues(); // Load default values
		} else {
			$tbl_product_detail_list->loadRowValues($tbl_product_detail_list->Recordset); // Load row values
		}
		$tbl_product_detail->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_product_detail->isEdit()) {
			if ($tbl_product_detail_list->checkInlineEditKey() && $tbl_product_detail_list->EditRowCnt == 0) { // Inline edit
				$tbl_product_detail->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($tbl_product_detail->isEdit() && $tbl_product_detail->RowType == ROWTYPE_EDIT && $tbl_product_detail->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$tbl_product_detail_list->restoreFormValues(); // Restore form values
		}
		if ($tbl_product_detail->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_product_detail_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$tbl_product_detail->RowAttrs = array_merge($tbl_product_detail->RowAttrs, array('data-rowindex'=>$tbl_product_detail_list->RowCnt, 'id'=>'r' . $tbl_product_detail_list->RowCnt . '_tbl_product_detail', 'data-rowtype'=>$tbl_product_detail->RowType));

		// Render row
		$tbl_product_detail_list->renderRow();

		// Render list options
		$tbl_product_detail_list->renderListOptions();
?>
	<tr<?php echo $tbl_product_detail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_product_detail_list->ListOptions->render("body", "left", $tbl_product_detail_list->RowCnt);
?>
	<?php if ($tbl_product_detail->PackingQty->Visible) { // PackingQty ?>
		<td data-name="PackingQty"<?php echo $tbl_product_detail->PackingQty->cellAttributes() ?>>
<?php if ($tbl_product_detail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_product_detail_list->RowCnt ?>_tbl_product_detail_PackingQty" class="form-group tbl_product_detail_PackingQty">
<input type="text" data-table="tbl_product_detail" data-field="x_PackingQty" name="x<?php echo $tbl_product_detail_list->RowIndex ?>_PackingQty" id="x<?php echo $tbl_product_detail_list->RowIndex ?>_PackingQty" size="5" placeholder="<?php echo HtmlEncode($tbl_product_detail->PackingQty->getPlaceHolder()) ?>" value="<?php echo $tbl_product_detail->PackingQty->EditValue ?>"<?php echo $tbl_product_detail->PackingQty->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_product_detail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_product_detail_list->RowCnt ?>_tbl_product_detail_PackingQty" class="tbl_product_detail_PackingQty">
<span<?php echo $tbl_product_detail->PackingQty->viewAttributes() ?>>
<?php echo $tbl_product_detail->PackingQty->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_product_detail->RowType == ROWTYPE_EDIT || $tbl_product_detail->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_product_detail" data-field="x_IdCode" name="x<?php echo $tbl_product_detail_list->RowIndex ?>_IdCode" id="x<?php echo $tbl_product_detail_list->RowIndex ?>_IdCode" value="<?php echo HtmlEncode($tbl_product_detail->IdCode->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_product_detail->IdUnit->Visible) { // IdUnit ?>
		<td data-name="IdUnit"<?php echo $tbl_product_detail->IdUnit->cellAttributes() ?>>
<?php if ($tbl_product_detail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_product_detail_list->RowCnt ?>_tbl_product_detail_IdUnit" class="form-group tbl_product_detail_IdUnit">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_product_detail" data-field="x_IdUnit" data-value-separator="<?php echo $tbl_product_detail->IdUnit->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_product_detail_list->RowIndex ?>_IdUnit" name="x<?php echo $tbl_product_detail_list->RowIndex ?>_IdUnit"<?php echo $tbl_product_detail->IdUnit->editAttributes() ?>>
		<?php echo $tbl_product_detail->IdUnit->selectOptionListHtml("x<?php echo $tbl_product_detail_list->RowIndex ?>_IdUnit") ?>
	</select>
</div>
<?php echo $tbl_product_detail->IdUnit->Lookup->getParamTag("p_x" . $tbl_product_detail_list->RowIndex . "_IdUnit") ?>
</span>
<?php } ?>
<?php if ($tbl_product_detail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_product_detail_list->RowCnt ?>_tbl_product_detail_IdUnit" class="tbl_product_detail_IdUnit">
<span<?php echo $tbl_product_detail->IdUnit->viewAttributes() ?>>
<?php echo $tbl_product_detail->IdUnit->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_product_detail->DefaultCode->Visible) { // DefaultCode ?>
		<td data-name="DefaultCode"<?php echo $tbl_product_detail->DefaultCode->cellAttributes() ?>>
<?php if ($tbl_product_detail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_product_detail_list->RowCnt ?>_tbl_product_detail_DefaultCode" class="form-group tbl_product_detail_DefaultCode">
<div id="tp_x<?php echo $tbl_product_detail_list->RowIndex ?>_DefaultCode" class="ew-template"><input type="radio" class="form-check-input" data-table="tbl_product_detail" data-field="x_DefaultCode" data-value-separator="<?php echo $tbl_product_detail->DefaultCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_product_detail_list->RowIndex ?>_DefaultCode" id="x<?php echo $tbl_product_detail_list->RowIndex ?>_DefaultCode" value="{value}"<?php echo $tbl_product_detail->DefaultCode->editAttributes() ?>></div>
<div id="dsl_x<?php echo $tbl_product_detail_list->RowIndex ?>_DefaultCode" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $tbl_product_detail->DefaultCode->radioButtonListHtml(FALSE, "x{$tbl_product_detail_list->RowIndex}_DefaultCode") ?>
</div></div>
</span>
<?php } ?>
<?php if ($tbl_product_detail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_product_detail_list->RowCnt ?>_tbl_product_detail_DefaultCode" class="tbl_product_detail_DefaultCode">
<span<?php echo $tbl_product_detail->DefaultCode->viewAttributes() ?>>
<?php echo $tbl_product_detail->DefaultCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_product_detail_list->ListOptions->render("body", "right", $tbl_product_detail_list->RowCnt);
?>
	</tr>
<?php if ($tbl_product_detail->RowType == ROWTYPE_ADD || $tbl_product_detail->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_product_detaillist.updateLists(<?php echo $tbl_product_detail_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	if (!$tbl_product_detail->isGridAdd())
		$tbl_product_detail_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($tbl_product_detail->isAdd() || $tbl_product_detail->isCopy()) { ?>
<input type="hidden" name="<?php echo $tbl_product_detail_list->FormKeyCountName ?>" id="<?php echo $tbl_product_detail_list->FormKeyCountName ?>" value="<?php echo $tbl_product_detail_list->KeyCount ?>">
<?php } ?>
<?php if ($tbl_product_detail->isEdit()) { ?>
<input type="hidden" name="<?php echo $tbl_product_detail_list->FormKeyCountName ?>" id="<?php echo $tbl_product_detail_list->FormKeyCountName ?>" value="<?php echo $tbl_product_detail_list->KeyCount ?>">
<?php } ?>
<?php if (!$tbl_product_detail->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_product_detail_list->Recordset)
	$tbl_product_detail_list->Recordset->Close();
?>
<?php if (!$tbl_product_detail->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_product_detail->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_product_detail_list->Pager)) $tbl_product_detail_list->Pager = new PrevNextPager($tbl_product_detail_list->StartRec, $tbl_product_detail_list->DisplayRecs, $tbl_product_detail_list->TotalRecs, $tbl_product_detail_list->AutoHidePager) ?>
<?php if ($tbl_product_detail_list->Pager->RecordCount > 0 && $tbl_product_detail_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_product_detail_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_product_detail_list->pageUrl() ?>start=<?php echo $tbl_product_detail_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_product_detail_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_product_detail_list->pageUrl() ?>start=<?php echo $tbl_product_detail_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_product_detail_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_product_detail_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_product_detail_list->pageUrl() ?>start=<?php echo $tbl_product_detail_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_product_detail_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_product_detail_list->pageUrl() ?>start=<?php echo $tbl_product_detail_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_product_detail_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_product_detail_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_product_detail_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_product_detail_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_product_detail_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_product_detail_list->TotalRecs > 0 && (!$tbl_product_detail_list->AutoHidePageSizeSelector || $tbl_product_detail_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_product_detail">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_product_detail_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_product_detail_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_product_detail_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_product_detail_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_product_detail_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_product_detail->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_product_detail_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_product_detail_list->TotalRecs == 0 && !$tbl_product_detail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_product_detail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_product_detail_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_product_detail->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_product_detail_list->terminate();
?>