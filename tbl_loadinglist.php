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
$tbl_loading_list = new tbl_loading_list();

// Run the page
$tbl_loading_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_loading_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_loading->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_loadinglist = currentForm = new ew.Form("ftbl_loadinglist", "list");
ftbl_loadinglist.formKeyCountName = '<?php echo $tbl_loading_list->FormKeyCountName ?>';

// Validate form
ftbl_loadinglist.validate = function() {
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
		<?php if ($tbl_loading_list->ID_Order->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_Order");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_loading->ID_Order->caption(), $tbl_loading->ID_Order->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_loading_list->CusomterOrderNo->Required) { ?>
			elm = this.getElements("x" + infix + "_CusomterOrderNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_loading->CusomterOrderNo->caption(), $tbl_loading->CusomterOrderNo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_loading_list->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_loading->CreateUser->caption(), $tbl_loading->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_loading_list->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_loading->CreateDate->caption(), $tbl_loading->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_loading_list->UpdateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_UpdateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_loading->UpdateUser->caption(), $tbl_loading->UpdateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_loading_list->UpdateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_UpdateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_loading->UpdateDate->caption(), $tbl_loading->UpdateDate->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftbl_loadinglist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_loadinglist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_loadinglist.lists["x_ID_Order"] = <?php echo $tbl_loading_list->ID_Order->Lookup->toClientList() ?>;
ftbl_loadinglist.lists["x_ID_Order"].options = <?php echo JsonEncode($tbl_loading_list->ID_Order->lookupOptions()) ?>;

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
<?php if (!$tbl_loading->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_loading_list->TotalRecs > 0 && $tbl_loading_list->ExportOptions->visible()) { ?>
<?php $tbl_loading_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_loading_list->ImportOptions->visible()) { ?>
<?php $tbl_loading_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$tbl_loading->isExport() || EXPORT_MASTER_RECORD && $tbl_loading->isExport("print")) { ?>
<?php
if ($tbl_loading_list->DbMasterFilter <> "" && $tbl_loading->getCurrentMasterTable() == "vwrouteout") {
	if ($tbl_loading_list->MasterRecordExists) {
		include_once "vwrouteoutmaster.php";
	}
}
?>
<?php } ?>
<?php
$tbl_loading_list->renderOtherOptions();
?>
<?php $tbl_loading_list->showPageHeader(); ?>
<?php
$tbl_loading_list->showMessage();
?>
<?php if ($tbl_loading_list->TotalRecs > 0 || $tbl_loading->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_loading_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_loading">
<?php if (!$tbl_loading->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_loading->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_loading_list->Pager)) $tbl_loading_list->Pager = new PrevNextPager($tbl_loading_list->StartRec, $tbl_loading_list->DisplayRecs, $tbl_loading_list->TotalRecs, $tbl_loading_list->AutoHidePager) ?>
<?php if ($tbl_loading_list->Pager->RecordCount > 0 && $tbl_loading_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_loading_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_loading_list->pageUrl() ?>start=<?php echo $tbl_loading_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_loading_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_loading_list->pageUrl() ?>start=<?php echo $tbl_loading_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_loading_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_loading_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_loading_list->pageUrl() ?>start=<?php echo $tbl_loading_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_loading_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_loading_list->pageUrl() ?>start=<?php echo $tbl_loading_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_loading_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_loading_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_loading_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_loading_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_loading_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_loading_list->TotalRecs > 0 && (!$tbl_loading_list->AutoHidePageSizeSelector || $tbl_loading_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_loading">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_loading_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_loading_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_loading_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_loading_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_loading_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_loading->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_loading_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_loadinglist" id="ftbl_loadinglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_loading_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_loading_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_loading">
<input type="hidden" name="exporttype" id="exporttype" value="">
<?php if ($tbl_loading->getCurrentMasterTable() == "vwrouteout" && $tbl_loading->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="vwrouteout">
<input type="hidden" name="fk_ID_Route" value="<?php echo $tbl_loading->ID_Route->getSessionValue() ?>">
<?php } ?>
<div id="gmp_tbl_loading" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_loading_list->TotalRecs > 0 || $tbl_loading->isAdd() || $tbl_loading->isCopy() || $tbl_loading->isGridEdit()) { ?>
<table id="tbl_tbl_loadinglist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_loading_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_loading_list->renderListOptions();

// Render list options (header, left)
$tbl_loading_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_loading->ID_Order->Visible) { // ID_Order ?>
	<?php if ($tbl_loading->sortUrl($tbl_loading->ID_Order) == "") { ?>
		<th data-name="ID_Order" class="<?php echo $tbl_loading->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_loading_ID_Order" class="tbl_loading_ID_Order"><div class="ew-table-header-caption"><?php echo $tbl_loading->ID_Order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Order" class="<?php echo $tbl_loading->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_loading->SortUrl($tbl_loading->ID_Order) ?>',2);"><div id="elh_tbl_loading_ID_Order" class="tbl_loading_ID_Order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_loading->ID_Order->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_loading->ID_Order->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_loading->ID_Order->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_loading->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
	<?php if ($tbl_loading->sortUrl($tbl_loading->CusomterOrderNo) == "") { ?>
		<th data-name="CusomterOrderNo" class="<?php echo $tbl_loading->CusomterOrderNo->headerCellClass() ?>"><div id="elh_tbl_loading_CusomterOrderNo" class="tbl_loading_CusomterOrderNo"><div class="ew-table-header-caption"><?php echo $tbl_loading->CusomterOrderNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CusomterOrderNo" class="<?php echo $tbl_loading->CusomterOrderNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_loading->SortUrl($tbl_loading->CusomterOrderNo) ?>',2);"><div id="elh_tbl_loading_CusomterOrderNo" class="tbl_loading_CusomterOrderNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_loading->CusomterOrderNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_loading->CusomterOrderNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_loading->CusomterOrderNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_loading->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_loading->sortUrl($tbl_loading->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_loading->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_loading_CreateUser" class="tbl_loading_CreateUser"><div class="ew-table-header-caption"><?php echo $tbl_loading->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_loading->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_loading->SortUrl($tbl_loading->CreateUser) ?>',2);"><div id="elh_tbl_loading_CreateUser" class="tbl_loading_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_loading->CreateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_loading->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_loading->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_loading->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_loading->sortUrl($tbl_loading->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_loading->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_loading_CreateDate" class="tbl_loading_CreateDate"><div class="ew-table-header-caption"><?php echo $tbl_loading->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_loading->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_loading->SortUrl($tbl_loading->CreateDate) ?>',2);"><div id="elh_tbl_loading_CreateDate" class="tbl_loading_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_loading->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_loading->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_loading->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_loading->UpdateUser->Visible) { // UpdateUser ?>
	<?php if ($tbl_loading->sortUrl($tbl_loading->UpdateUser) == "") { ?>
		<th data-name="UpdateUser" class="<?php echo $tbl_loading->UpdateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_loading_UpdateUser" class="tbl_loading_UpdateUser"><div class="ew-table-header-caption"><?php echo $tbl_loading->UpdateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UpdateUser" class="<?php echo $tbl_loading->UpdateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_loading->SortUrl($tbl_loading->UpdateUser) ?>',2);"><div id="elh_tbl_loading_UpdateUser" class="tbl_loading_UpdateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_loading->UpdateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_loading->UpdateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_loading->UpdateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_loading->UpdateDate->Visible) { // UpdateDate ?>
	<?php if ($tbl_loading->sortUrl($tbl_loading->UpdateDate) == "") { ?>
		<th data-name="UpdateDate" class="<?php echo $tbl_loading->UpdateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_loading_UpdateDate" class="tbl_loading_UpdateDate"><div class="ew-table-header-caption"><?php echo $tbl_loading->UpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UpdateDate" class="<?php echo $tbl_loading->UpdateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_loading->SortUrl($tbl_loading->UpdateDate) ?>',2);"><div id="elh_tbl_loading_UpdateDate" class="tbl_loading_UpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_loading->UpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_loading->UpdateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_loading->UpdateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_loading_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($tbl_loading->isAdd() || $tbl_loading->isCopy()) {
		$tbl_loading_list->RowIndex = 0;
		$tbl_loading_list->KeyCount = $tbl_loading_list->RowIndex;
		if ($tbl_loading->isAdd())
			$tbl_loading_list->loadRowValues();
		if ($tbl_loading->EventCancelled) // Insert failed
			$tbl_loading_list->restoreFormValues(); // Restore form values

		// Set row properties
		$tbl_loading->resetAttributes();
		$tbl_loading->RowAttrs = array_merge($tbl_loading->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_tbl_loading', 'data-rowtype'=>ROWTYPE_ADD));
		$tbl_loading->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_loading_list->renderRow();

		// Render list options
		$tbl_loading_list->renderListOptions();
		$tbl_loading_list->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_loading->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_loading_list->ListOptions->render("body", "left", $tbl_loading_list->RowCnt);
?>
	<?php if ($tbl_loading->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order">
<span id="el<?php echo $tbl_loading_list->RowCnt ?>_tbl_loading_ID_Order" class="form-group tbl_loading_ID_Order">
<?php $tbl_loading->ID_Order->EditAttrs["onchange"] = "ew.autoFill(this);" . @$tbl_loading->ID_Order->EditAttrs["onchange"]; ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_loading" data-field="x_ID_Order" data-value-separator="<?php echo $tbl_loading->ID_Order->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_loading_list->RowIndex ?>_ID_Order" name="x<?php echo $tbl_loading_list->RowIndex ?>_ID_Order"<?php echo $tbl_loading->ID_Order->editAttributes() ?>>
		<?php echo $tbl_loading->ID_Order->selectOptionListHtml("x<?php echo $tbl_loading_list->RowIndex ?>_ID_Order") ?>
	</select>
</div>
<?php echo $tbl_loading->ID_Order->Lookup->getParamTag("p_x" . $tbl_loading_list->RowIndex . "_ID_Order") ?>
</span>
<input type="hidden" data-table="tbl_loading" data-field="x_ID_Order" name="o<?php echo $tbl_loading_list->RowIndex ?>_ID_Order" id="o<?php echo $tbl_loading_list->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($tbl_loading->ID_Order->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_loading->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
		<td data-name="CusomterOrderNo">
<span id="el<?php echo $tbl_loading_list->RowCnt ?>_tbl_loading_CusomterOrderNo" class="form-group tbl_loading_CusomterOrderNo">
<input type="text" data-table="tbl_loading" data-field="x_CusomterOrderNo" name="x<?php echo $tbl_loading_list->RowIndex ?>_CusomterOrderNo" id="x<?php echo $tbl_loading_list->RowIndex ?>_CusomterOrderNo" size="20" maxlength="15" placeholder="<?php echo HtmlEncode($tbl_loading->CusomterOrderNo->getPlaceHolder()) ?>" value="<?php echo $tbl_loading->CusomterOrderNo->EditValue ?>"<?php echo $tbl_loading->CusomterOrderNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_loading" data-field="x_CusomterOrderNo" name="o<?php echo $tbl_loading_list->RowIndex ?>_CusomterOrderNo" id="o<?php echo $tbl_loading_list->RowIndex ?>_CusomterOrderNo" value="<?php echo HtmlEncode($tbl_loading->CusomterOrderNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_loading->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser">
<input type="hidden" data-table="tbl_loading" data-field="x_CreateUser" name="o<?php echo $tbl_loading_list->RowIndex ?>_CreateUser" id="o<?php echo $tbl_loading_list->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_loading->CreateUser->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_loading->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate">
<input type="hidden" data-table="tbl_loading" data-field="x_CreateDate" name="o<?php echo $tbl_loading_list->RowIndex ?>_CreateDate" id="o<?php echo $tbl_loading_list->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_loading->CreateDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_loading->UpdateUser->Visible) { // UpdateUser ?>
		<td data-name="UpdateUser">
<input type="hidden" data-table="tbl_loading" data-field="x_UpdateUser" name="o<?php echo $tbl_loading_list->RowIndex ?>_UpdateUser" id="o<?php echo $tbl_loading_list->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($tbl_loading->UpdateUser->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_loading->UpdateDate->Visible) { // UpdateDate ?>
		<td data-name="UpdateDate">
<input type="hidden" data-table="tbl_loading" data-field="x_UpdateDate" name="o<?php echo $tbl_loading_list->RowIndex ?>_UpdateDate" id="o<?php echo $tbl_loading_list->RowIndex ?>_UpdateDate" value="<?php echo HtmlEncode($tbl_loading->UpdateDate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_loading_list->ListOptions->render("body", "right", $tbl_loading_list->RowCnt);
?>
<script>
ftbl_loadinglist.updateLists(<?php echo $tbl_loading_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($tbl_loading->ExportAll && $tbl_loading->isExport()) {
	$tbl_loading_list->StopRec = $tbl_loading_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_loading_list->TotalRecs > $tbl_loading_list->StartRec + $tbl_loading_list->DisplayRecs - 1)
		$tbl_loading_list->StopRec = $tbl_loading_list->StartRec + $tbl_loading_list->DisplayRecs - 1;
	else
		$tbl_loading_list->StopRec = $tbl_loading_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $tbl_loading_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_loading_list->FormKeyCountName) && ($tbl_loading->isGridAdd() || $tbl_loading->isGridEdit() || $tbl_loading->isConfirm())) {
		$tbl_loading_list->KeyCount = $CurrentForm->getValue($tbl_loading_list->FormKeyCountName);
		$tbl_loading_list->StopRec = $tbl_loading_list->StartRec + $tbl_loading_list->KeyCount - 1;
	}
}
$tbl_loading_list->RecCnt = $tbl_loading_list->StartRec - 1;
if ($tbl_loading_list->Recordset && !$tbl_loading_list->Recordset->EOF) {
	$tbl_loading_list->Recordset->moveFirst();
	$selectLimit = $tbl_loading_list->UseSelectLimit;
	if (!$selectLimit && $tbl_loading_list->StartRec > 1)
		$tbl_loading_list->Recordset->move($tbl_loading_list->StartRec - 1);
} elseif (!$tbl_loading->AllowAddDeleteRow && $tbl_loading_list->StopRec == 0) {
	$tbl_loading_list->StopRec = $tbl_loading->GridAddRowCount;
}

// Initialize aggregate
$tbl_loading->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_loading->resetAttributes();
$tbl_loading_list->renderRow();
$tbl_loading_list->EditRowCnt = 0;
if ($tbl_loading->isEdit())
	$tbl_loading_list->RowIndex = 1;
if ($tbl_loading->isGridEdit())
	$tbl_loading_list->RowIndex = 0;
while ($tbl_loading_list->RecCnt < $tbl_loading_list->StopRec) {
	$tbl_loading_list->RecCnt++;
	if ($tbl_loading_list->RecCnt >= $tbl_loading_list->StartRec) {
		$tbl_loading_list->RowCnt++;
		if ($tbl_loading->isGridAdd() || $tbl_loading->isGridEdit() || $tbl_loading->isConfirm()) {
			$tbl_loading_list->RowIndex++;
			$CurrentForm->Index = $tbl_loading_list->RowIndex;
			if ($CurrentForm->hasValue($tbl_loading_list->FormActionName) && $tbl_loading_list->EventCancelled)
				$tbl_loading_list->RowAction = strval($CurrentForm->getValue($tbl_loading_list->FormActionName));
			elseif ($tbl_loading->isGridAdd())
				$tbl_loading_list->RowAction = "insert";
			else
				$tbl_loading_list->RowAction = "";
		}

		// Set up key count
		$tbl_loading_list->KeyCount = $tbl_loading_list->RowIndex;

		// Init row class and style
		$tbl_loading->resetAttributes();
		$tbl_loading->CssClass = "";
		if ($tbl_loading->isGridAdd()) {
			$tbl_loading_list->loadRowValues(); // Load default values
		} else {
			$tbl_loading_list->loadRowValues($tbl_loading_list->Recordset); // Load row values
		}
		$tbl_loading->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_loading->isEdit()) {
			if ($tbl_loading_list->checkInlineEditKey() && $tbl_loading_list->EditRowCnt == 0) { // Inline edit
				$tbl_loading->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($tbl_loading->isGridEdit()) { // Grid edit
			if ($tbl_loading->EventCancelled)
				$tbl_loading_list->restoreCurrentRowFormValues($tbl_loading_list->RowIndex); // Restore form values
			if ($tbl_loading_list->RowAction == "insert")
				$tbl_loading->RowType = ROWTYPE_ADD; // Render add
			else
				$tbl_loading->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_loading->isEdit() && $tbl_loading->RowType == ROWTYPE_EDIT && $tbl_loading->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$tbl_loading_list->restoreFormValues(); // Restore form values
		}
		if ($tbl_loading->isGridEdit() && ($tbl_loading->RowType == ROWTYPE_EDIT || $tbl_loading->RowType == ROWTYPE_ADD) && $tbl_loading->EventCancelled) // Update failed
			$tbl_loading_list->restoreCurrentRowFormValues($tbl_loading_list->RowIndex); // Restore form values
		if ($tbl_loading->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_loading_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$tbl_loading->RowAttrs = array_merge($tbl_loading->RowAttrs, array('data-rowindex'=>$tbl_loading_list->RowCnt, 'id'=>'r' . $tbl_loading_list->RowCnt . '_tbl_loading', 'data-rowtype'=>$tbl_loading->RowType));

		// Render row
		$tbl_loading_list->renderRow();

		// Render list options
		$tbl_loading_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_loading_list->RowAction <> "delete" && $tbl_loading_list->RowAction <> "insertdelete" && !($tbl_loading_list->RowAction == "insert" && $tbl_loading->isConfirm() && $tbl_loading_list->emptyRow())) {
?>
	<tr<?php echo $tbl_loading->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_loading_list->ListOptions->render("body", "left", $tbl_loading_list->RowCnt);
?>
	<?php if ($tbl_loading->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order"<?php echo $tbl_loading->ID_Order->cellAttributes() ?>>
<?php if ($tbl_loading->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_loading_list->RowCnt ?>_tbl_loading_ID_Order" class="form-group tbl_loading_ID_Order">
<?php $tbl_loading->ID_Order->EditAttrs["onchange"] = "ew.autoFill(this);" . @$tbl_loading->ID_Order->EditAttrs["onchange"]; ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_loading" data-field="x_ID_Order" data-value-separator="<?php echo $tbl_loading->ID_Order->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_loading_list->RowIndex ?>_ID_Order" name="x<?php echo $tbl_loading_list->RowIndex ?>_ID_Order"<?php echo $tbl_loading->ID_Order->editAttributes() ?>>
		<?php echo $tbl_loading->ID_Order->selectOptionListHtml("x<?php echo $tbl_loading_list->RowIndex ?>_ID_Order") ?>
	</select>
</div>
<?php echo $tbl_loading->ID_Order->Lookup->getParamTag("p_x" . $tbl_loading_list->RowIndex . "_ID_Order") ?>
</span>
<input type="hidden" data-table="tbl_loading" data-field="x_ID_Order" name="o<?php echo $tbl_loading_list->RowIndex ?>_ID_Order" id="o<?php echo $tbl_loading_list->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($tbl_loading->ID_Order->OldValue) ?>">
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_loading_list->RowCnt ?>_tbl_loading_ID_Order" class="form-group tbl_loading_ID_Order">
<?php $tbl_loading->ID_Order->EditAttrs["onchange"] = "ew.autoFill(this);" . @$tbl_loading->ID_Order->EditAttrs["onchange"]; ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_loading" data-field="x_ID_Order" data-value-separator="<?php echo $tbl_loading->ID_Order->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_loading_list->RowIndex ?>_ID_Order" name="x<?php echo $tbl_loading_list->RowIndex ?>_ID_Order"<?php echo $tbl_loading->ID_Order->editAttributes() ?>>
		<?php echo $tbl_loading->ID_Order->selectOptionListHtml("x<?php echo $tbl_loading_list->RowIndex ?>_ID_Order") ?>
	</select>
</div>
<?php echo $tbl_loading->ID_Order->Lookup->getParamTag("p_x" . $tbl_loading_list->RowIndex . "_ID_Order") ?>
</span>
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_loading_list->RowCnt ?>_tbl_loading_ID_Order" class="tbl_loading_ID_Order">
<span<?php echo $tbl_loading->ID_Order->viewAttributes() ?>>
<?php echo $tbl_loading->ID_Order->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_loading" data-field="x_ID_Loading" name="x<?php echo $tbl_loading_list->RowIndex ?>_ID_Loading" id="x<?php echo $tbl_loading_list->RowIndex ?>_ID_Loading" value="<?php echo HtmlEncode($tbl_loading->ID_Loading->CurrentValue) ?>">
<input type="hidden" data-table="tbl_loading" data-field="x_ID_Loading" name="o<?php echo $tbl_loading_list->RowIndex ?>_ID_Loading" id="o<?php echo $tbl_loading_list->RowIndex ?>_ID_Loading" value="<?php echo HtmlEncode($tbl_loading->ID_Loading->OldValue) ?>">
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_EDIT || $tbl_loading->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_loading" data-field="x_ID_Loading" name="x<?php echo $tbl_loading_list->RowIndex ?>_ID_Loading" id="x<?php echo $tbl_loading_list->RowIndex ?>_ID_Loading" value="<?php echo HtmlEncode($tbl_loading->ID_Loading->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_loading->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
		<td data-name="CusomterOrderNo"<?php echo $tbl_loading->CusomterOrderNo->cellAttributes() ?>>
<?php if ($tbl_loading->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_loading_list->RowCnt ?>_tbl_loading_CusomterOrderNo" class="form-group tbl_loading_CusomterOrderNo">
<input type="text" data-table="tbl_loading" data-field="x_CusomterOrderNo" name="x<?php echo $tbl_loading_list->RowIndex ?>_CusomterOrderNo" id="x<?php echo $tbl_loading_list->RowIndex ?>_CusomterOrderNo" size="20" maxlength="15" placeholder="<?php echo HtmlEncode($tbl_loading->CusomterOrderNo->getPlaceHolder()) ?>" value="<?php echo $tbl_loading->CusomterOrderNo->EditValue ?>"<?php echo $tbl_loading->CusomterOrderNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_loading" data-field="x_CusomterOrderNo" name="o<?php echo $tbl_loading_list->RowIndex ?>_CusomterOrderNo" id="o<?php echo $tbl_loading_list->RowIndex ?>_CusomterOrderNo" value="<?php echo HtmlEncode($tbl_loading->CusomterOrderNo->OldValue) ?>">
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_loading_list->RowCnt ?>_tbl_loading_CusomterOrderNo" class="form-group tbl_loading_CusomterOrderNo">
<input type="text" data-table="tbl_loading" data-field="x_CusomterOrderNo" name="x<?php echo $tbl_loading_list->RowIndex ?>_CusomterOrderNo" id="x<?php echo $tbl_loading_list->RowIndex ?>_CusomterOrderNo" size="20" maxlength="15" placeholder="<?php echo HtmlEncode($tbl_loading->CusomterOrderNo->getPlaceHolder()) ?>" value="<?php echo $tbl_loading->CusomterOrderNo->EditValue ?>"<?php echo $tbl_loading->CusomterOrderNo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_loading_list->RowCnt ?>_tbl_loading_CusomterOrderNo" class="tbl_loading_CusomterOrderNo">
<span<?php echo $tbl_loading->CusomterOrderNo->viewAttributes() ?>>
<?php echo $tbl_loading->CusomterOrderNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_loading->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $tbl_loading->CreateUser->cellAttributes() ?>>
<?php if ($tbl_loading->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_loading" data-field="x_CreateUser" name="o<?php echo $tbl_loading_list->RowIndex ?>_CreateUser" id="o<?php echo $tbl_loading_list->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_loading->CreateUser->OldValue) ?>">
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_loading_list->RowCnt ?>_tbl_loading_CreateUser" class="tbl_loading_CreateUser">
<span<?php echo $tbl_loading->CreateUser->viewAttributes() ?>>
<?php echo $tbl_loading->CreateUser->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_loading->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $tbl_loading->CreateDate->cellAttributes() ?>>
<?php if ($tbl_loading->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_loading" data-field="x_CreateDate" name="o<?php echo $tbl_loading_list->RowIndex ?>_CreateDate" id="o<?php echo $tbl_loading_list->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_loading->CreateDate->OldValue) ?>">
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_loading_list->RowCnt ?>_tbl_loading_CreateDate" class="tbl_loading_CreateDate">
<span<?php echo $tbl_loading->CreateDate->viewAttributes() ?>>
<?php echo $tbl_loading->CreateDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_loading->UpdateUser->Visible) { // UpdateUser ?>
		<td data-name="UpdateUser"<?php echo $tbl_loading->UpdateUser->cellAttributes() ?>>
<?php if ($tbl_loading->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_loading" data-field="x_UpdateUser" name="o<?php echo $tbl_loading_list->RowIndex ?>_UpdateUser" id="o<?php echo $tbl_loading_list->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($tbl_loading->UpdateUser->OldValue) ?>">
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_loading_list->RowCnt ?>_tbl_loading_UpdateUser" class="tbl_loading_UpdateUser">
<span<?php echo $tbl_loading->UpdateUser->viewAttributes() ?>>
<?php echo $tbl_loading->UpdateUser->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_loading->UpdateDate->Visible) { // UpdateDate ?>
		<td data-name="UpdateDate"<?php echo $tbl_loading->UpdateDate->cellAttributes() ?>>
<?php if ($tbl_loading->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_loading" data-field="x_UpdateDate" name="o<?php echo $tbl_loading_list->RowIndex ?>_UpdateDate" id="o<?php echo $tbl_loading_list->RowIndex ?>_UpdateDate" value="<?php echo HtmlEncode($tbl_loading->UpdateDate->OldValue) ?>">
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_loading_list->RowCnt ?>_tbl_loading_UpdateDate" class="tbl_loading_UpdateDate">
<span<?php echo $tbl_loading->UpdateDate->viewAttributes() ?>>
<?php echo $tbl_loading->UpdateDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_loading_list->ListOptions->render("body", "right", $tbl_loading_list->RowCnt);
?>
	</tr>
<?php if ($tbl_loading->RowType == ROWTYPE_ADD || $tbl_loading->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_loadinglist.updateLists(<?php echo $tbl_loading_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$tbl_loading->isGridAdd())
		if (!$tbl_loading_list->Recordset->EOF)
			$tbl_loading_list->Recordset->moveNext();
}
?>
<?php
	if ($tbl_loading->isGridAdd() || $tbl_loading->isGridEdit()) {
		$tbl_loading_list->RowIndex = '$rowindex$';
		$tbl_loading_list->loadRowValues();

		// Set row properties
		$tbl_loading->resetAttributes();
		$tbl_loading->RowAttrs = array_merge($tbl_loading->RowAttrs, array('data-rowindex'=>$tbl_loading_list->RowIndex, 'id'=>'r0_tbl_loading', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($tbl_loading->RowAttrs["class"], "ew-template");
		$tbl_loading->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_loading_list->renderRow();

		// Render list options
		$tbl_loading_list->renderListOptions();
		$tbl_loading_list->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_loading->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_loading_list->ListOptions->render("body", "left", $tbl_loading_list->RowIndex);
?>
	<?php if ($tbl_loading->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order">
<span id="el$rowindex$_tbl_loading_ID_Order" class="form-group tbl_loading_ID_Order">
<?php $tbl_loading->ID_Order->EditAttrs["onchange"] = "ew.autoFill(this);" . @$tbl_loading->ID_Order->EditAttrs["onchange"]; ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_loading" data-field="x_ID_Order" data-value-separator="<?php echo $tbl_loading->ID_Order->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_loading_list->RowIndex ?>_ID_Order" name="x<?php echo $tbl_loading_list->RowIndex ?>_ID_Order"<?php echo $tbl_loading->ID_Order->editAttributes() ?>>
		<?php echo $tbl_loading->ID_Order->selectOptionListHtml("x<?php echo $tbl_loading_list->RowIndex ?>_ID_Order") ?>
	</select>
</div>
<?php echo $tbl_loading->ID_Order->Lookup->getParamTag("p_x" . $tbl_loading_list->RowIndex . "_ID_Order") ?>
</span>
<input type="hidden" data-table="tbl_loading" data-field="x_ID_Order" name="o<?php echo $tbl_loading_list->RowIndex ?>_ID_Order" id="o<?php echo $tbl_loading_list->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($tbl_loading->ID_Order->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_loading->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
		<td data-name="CusomterOrderNo">
<span id="el$rowindex$_tbl_loading_CusomterOrderNo" class="form-group tbl_loading_CusomterOrderNo">
<input type="text" data-table="tbl_loading" data-field="x_CusomterOrderNo" name="x<?php echo $tbl_loading_list->RowIndex ?>_CusomterOrderNo" id="x<?php echo $tbl_loading_list->RowIndex ?>_CusomterOrderNo" size="20" maxlength="15" placeholder="<?php echo HtmlEncode($tbl_loading->CusomterOrderNo->getPlaceHolder()) ?>" value="<?php echo $tbl_loading->CusomterOrderNo->EditValue ?>"<?php echo $tbl_loading->CusomterOrderNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_loading" data-field="x_CusomterOrderNo" name="o<?php echo $tbl_loading_list->RowIndex ?>_CusomterOrderNo" id="o<?php echo $tbl_loading_list->RowIndex ?>_CusomterOrderNo" value="<?php echo HtmlEncode($tbl_loading->CusomterOrderNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_loading->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser">
<input type="hidden" data-table="tbl_loading" data-field="x_CreateUser" name="o<?php echo $tbl_loading_list->RowIndex ?>_CreateUser" id="o<?php echo $tbl_loading_list->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_loading->CreateUser->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_loading->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate">
<input type="hidden" data-table="tbl_loading" data-field="x_CreateDate" name="o<?php echo $tbl_loading_list->RowIndex ?>_CreateDate" id="o<?php echo $tbl_loading_list->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_loading->CreateDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_loading->UpdateUser->Visible) { // UpdateUser ?>
		<td data-name="UpdateUser">
<input type="hidden" data-table="tbl_loading" data-field="x_UpdateUser" name="o<?php echo $tbl_loading_list->RowIndex ?>_UpdateUser" id="o<?php echo $tbl_loading_list->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($tbl_loading->UpdateUser->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_loading->UpdateDate->Visible) { // UpdateDate ?>
		<td data-name="UpdateDate">
<input type="hidden" data-table="tbl_loading" data-field="x_UpdateDate" name="o<?php echo $tbl_loading_list->RowIndex ?>_UpdateDate" id="o<?php echo $tbl_loading_list->RowIndex ?>_UpdateDate" value="<?php echo HtmlEncode($tbl_loading->UpdateDate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_loading_list->ListOptions->render("body", "right", $tbl_loading_list->RowIndex);
?>
<script>
ftbl_loadinglist.updateLists(<?php echo $tbl_loading_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($tbl_loading->isAdd() || $tbl_loading->isCopy()) { ?>
<input type="hidden" name="<?php echo $tbl_loading_list->FormKeyCountName ?>" id="<?php echo $tbl_loading_list->FormKeyCountName ?>" value="<?php echo $tbl_loading_list->KeyCount ?>">
<?php } ?>
<?php if ($tbl_loading->isEdit()) { ?>
<input type="hidden" name="<?php echo $tbl_loading_list->FormKeyCountName ?>" id="<?php echo $tbl_loading_list->FormKeyCountName ?>" value="<?php echo $tbl_loading_list->KeyCount ?>">
<?php } ?>
<?php if ($tbl_loading->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $tbl_loading_list->FormKeyCountName ?>" id="<?php echo $tbl_loading_list->FormKeyCountName ?>" value="<?php echo $tbl_loading_list->KeyCount ?>">
<?php echo $tbl_loading_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$tbl_loading->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_loading_list->Recordset)
	$tbl_loading_list->Recordset->Close();
?>
<?php if (!$tbl_loading->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_loading->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_loading_list->Pager)) $tbl_loading_list->Pager = new PrevNextPager($tbl_loading_list->StartRec, $tbl_loading_list->DisplayRecs, $tbl_loading_list->TotalRecs, $tbl_loading_list->AutoHidePager) ?>
<?php if ($tbl_loading_list->Pager->RecordCount > 0 && $tbl_loading_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_loading_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_loading_list->pageUrl() ?>start=<?php echo $tbl_loading_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_loading_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_loading_list->pageUrl() ?>start=<?php echo $tbl_loading_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_loading_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_loading_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_loading_list->pageUrl() ?>start=<?php echo $tbl_loading_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_loading_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_loading_list->pageUrl() ?>start=<?php echo $tbl_loading_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_loading_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_loading_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_loading_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_loading_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_loading_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_loading_list->TotalRecs > 0 && (!$tbl_loading_list->AutoHidePageSizeSelector || $tbl_loading_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_loading">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_loading_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_loading_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_loading_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_loading_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_loading_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_loading->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_loading_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_loading_list->TotalRecs == 0 && !$tbl_loading->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_loading_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_loading_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_loading->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_loading_list->terminate();
?>