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
$tbl_inventory_list = new tbl_inventory_list();

// Run the page
$tbl_inventory_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_inventory_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_inventory->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_inventorylist = currentForm = new ew.Form("ftbl_inventorylist", "list");
ftbl_inventorylist.formKeyCountName = '<?php echo $tbl_inventory_list->FormKeyCountName ?>';

// Validate form
ftbl_inventorylist.validate = function() {
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
		<?php if ($tbl_inventory_list->In_Year->Required) { ?>
			elm = this.getElements("x" + infix + "_In_Year");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory->In_Year->caption(), $tbl_inventory->In_Year->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_inventory_list->In_Month->Required) { ?>
			elm = this.getElements("x" + infix + "_In_Month");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory->In_Month->caption(), $tbl_inventory->In_Month->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_inventory_list->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory->Code->caption(), $tbl_inventory->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_inventory_list->ProductName->Required) { ?>
			elm = this.getElements("x" + infix + "_ProductName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory->ProductName->caption(), $tbl_inventory->ProductName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_inventory_list->TypeName->Required) { ?>
			elm = this.getElements("x" + infix + "_TypeName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory->TypeName->caption(), $tbl_inventory->TypeName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_inventory_list->OpeningStock->Required) { ?>
			elm = this.getElements("x" + infix + "_OpeningStock");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory->OpeningStock->caption(), $tbl_inventory->OpeningStock->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_inventory_list->PCS_IN->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS_IN");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory->PCS_IN->caption(), $tbl_inventory->PCS_IN->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_inventory_list->PCS_OUT->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS_OUT");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory->PCS_OUT->caption(), $tbl_inventory->PCS_OUT->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_inventory_list->ClosingStock->Required) { ?>
			elm = this.getElements("x" + infix + "_ClosingStock");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory->ClosingStock->caption(), $tbl_inventory->ClosingStock->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_inventory_list->LockStock->Required) { ?>
			elm = this.getElements("x" + infix + "_LockStock");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory->LockStock->caption(), $tbl_inventory->LockStock->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftbl_inventorylist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_inventorylist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_inventorylist.lists["x_TypeName"] = <?php echo $tbl_inventory_list->TypeName->Lookup->toClientList() ?>;
ftbl_inventorylist.lists["x_TypeName"].options = <?php echo JsonEncode($tbl_inventory_list->TypeName->lookupOptions()) ?>;
ftbl_inventorylist.lists["x_LockStock"] = <?php echo $tbl_inventory_list->LockStock->Lookup->toClientList() ?>;
ftbl_inventorylist.lists["x_LockStock"].options = <?php echo JsonEncode($tbl_inventory_list->LockStock->options(FALSE, TRUE)) ?>;

// Form object for search
var ftbl_inventorylistsrch = currentSearchForm = new ew.Form("ftbl_inventorylistsrch");

// Validate function for search
ftbl_inventorylistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_In_Year");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($tbl_inventory->In_Year->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_In_Month");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($tbl_inventory->In_Month->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
ftbl_inventorylistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_inventorylistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_inventorylistsrch.lists["x_TypeName"] = <?php echo $tbl_inventory_list->TypeName->Lookup->toClientList() ?>;
ftbl_inventorylistsrch.lists["x_TypeName"].options = <?php echo JsonEncode($tbl_inventory_list->TypeName->lookupOptions()) ?>;

// Filters
ftbl_inventorylistsrch.filterList = <?php echo $tbl_inventory_list->getFilterList() ?>;
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
<?php if (!$tbl_inventory->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_inventory_list->TotalRecs > 0 && $tbl_inventory_list->ExportOptions->visible()) { ?>
<?php $tbl_inventory_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_inventory_list->ImportOptions->visible()) { ?>
<?php $tbl_inventory_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_inventory_list->SearchOptions->visible()) { ?>
<?php $tbl_inventory_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_inventory_list->FilterOptions->visible()) { ?>
<?php $tbl_inventory_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_inventory_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_inventory->isExport() && !$tbl_inventory->CurrentAction) { ?>
<form name="ftbl_inventorylistsrch" id="ftbl_inventorylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tbl_inventory_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftbl_inventorylistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_inventory">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$tbl_inventory_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$tbl_inventory->RowType = ROWTYPE_SEARCH;

// Render row
$tbl_inventory->resetAttributes();
$tbl_inventory_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($tbl_inventory->In_Year->Visible) { // In_Year ?>
	<div id="xsc_In_Year" class="ew-cell form-group">
		<label for="x_In_Year" class="ew-search-caption ew-label"><?php echo $tbl_inventory->In_Year->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_In_Year" id="z_In_Year" value="="></span>
		<span class="ew-search-field">
<input type="text" data-table="tbl_inventory" data-field="x_In_Year" name="x_In_Year" id="x_In_Year" size="10" placeholder="<?php echo HtmlEncode($tbl_inventory->In_Year->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->In_Year->EditValue ?>"<?php echo $tbl_inventory->In_Year->editAttributes() ?>>
</span>
	</div>
<?php } ?>
<?php if ($tbl_inventory->In_Month->Visible) { // In_Month ?>
	<div id="xsc_In_Month" class="ew-cell form-group">
		<label for="x_In_Month" class="ew-search-caption ew-label"><?php echo $tbl_inventory->In_Month->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_In_Month" id="z_In_Month" value="="></span>
		<span class="ew-search-field">
<input type="text" data-table="tbl_inventory" data-field="x_In_Month" name="x_In_Month" id="x_In_Month" size="5" placeholder="<?php echo HtmlEncode($tbl_inventory->In_Month->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->In_Month->EditValue ?>"<?php echo $tbl_inventory->In_Month->editAttributes() ?>>
</span>
	</div>
<?php } ?>

<?php if ($tbl_inventory->TypeName->Visible) { // TypeName ?>
	<div id="xsc_TypeName" class="ew-cell form-group">
		<label for="x_TypeName" class="ew-search-caption ew-label"><?php echo $tbl_inventory->TypeName->caption() ?></label>
		<span class="ew-search-operator"><?php // echo $Language->phrase("LIKE") ?><input type="hidden" name="z_TypeName" id="z_TypeName" value="LIKE"></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_TypeName" data-value-separator="<?php echo $tbl_inventory->TypeName->displayValueSeparatorAttribute() ?>" id="x_TypeName" name="x_TypeName"<?php echo $tbl_inventory->TypeName->editAttributes() ?>>
		<?php echo $tbl_inventory->TypeName->selectOptionListHtml("x_TypeName") ?>
	</select>
</div>
<?php echo $tbl_inventory->TypeName->Lookup->getParamTag("p_x_TypeName") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_4" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tbl_inventory_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tbl_inventory_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_inventory_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_inventory_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_inventory_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_inventory_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_inventory_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tbl_inventory_list->showPageHeader(); ?>
<?php
$tbl_inventory_list->showMessage();
?>
<button id="idRefresh" class="btn btn-outline-danger" >Refresh</button>
<input type="button" id="idprint" class="btn btn-outline-primary btnx" value="Export excel">
<?php if ($tbl_inventory_list->TotalRecs > 0 || $tbl_inventory->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_inventory_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_inventory">
<?php if (!$tbl_inventory->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_inventory->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_inventory_list->Pager)) $tbl_inventory_list->Pager = new PrevNextPager($tbl_inventory_list->StartRec, $tbl_inventory_list->DisplayRecs, $tbl_inventory_list->TotalRecs, $tbl_inventory_list->AutoHidePager) ?>
<?php if ($tbl_inventory_list->Pager->RecordCount > 0 && $tbl_inventory_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_inventory_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_inventory_list->pageUrl() ?>start=<?php echo $tbl_inventory_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_inventory_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_inventory_list->pageUrl() ?>start=<?php echo $tbl_inventory_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_inventory_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_inventory_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_inventory_list->pageUrl() ?>start=<?php echo $tbl_inventory_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_inventory_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_inventory_list->pageUrl() ?>start=<?php echo $tbl_inventory_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_inventory_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_inventory_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_inventory_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_inventory_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_inventory_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_inventory_list->TotalRecs > 0 && (!$tbl_inventory_list->AutoHidePageSizeSelector || $tbl_inventory_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_inventory">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_inventory_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_inventory_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_inventory_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_inventory_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_inventory_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="5000"<?php if ($tbl_inventory_list->DisplayRecs == 5000) { ?> selected<?php } ?>>5000</option>
<option value="ALL"<?php if ($tbl_inventory->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_inventory_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_inventorylist" id="ftbl_inventorylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_inventory_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_inventory_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_inventory">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_tbl_inventory" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_inventory_list->TotalRecs > 0 || $tbl_inventory->isGridEdit()) { ?>
<table id="tbl_tbl_inventorylist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_inventory_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_inventory_list->renderListOptions();

// Render list options (header, left)
$tbl_inventory_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_inventory->In_Year->Visible) { // In_Year ?>
	<?php if ($tbl_inventory->sortUrl($tbl_inventory->In_Year) == "") { ?>
		<th data-name="In_Year" class="<?php echo $tbl_inventory->In_Year->headerCellClass() ?>" style="width: 50px; white-space: nowrap;"><div id="elh_tbl_inventory_In_Year" class="tbl_inventory_In_Year"><div class="ew-table-header-caption"><?php echo $tbl_inventory->In_Year->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="In_Year" class="<?php echo $tbl_inventory->In_Year->headerCellClass() ?>" style="width: 50px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_inventory->SortUrl($tbl_inventory->In_Year) ?>',2);"><div id="elh_tbl_inventory_In_Year" class="tbl_inventory_In_Year">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_inventory->In_Year->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_inventory->In_Year->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_inventory->In_Year->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_inventory->In_Month->Visible) { // In_Month ?>
	<?php if ($tbl_inventory->sortUrl($tbl_inventory->In_Month) == "") { ?>
		<th data-name="In_Month" class="<?php echo $tbl_inventory->In_Month->headerCellClass() ?>" style="width: 20px; white-space: nowrap;"><div id="elh_tbl_inventory_In_Month" class="tbl_inventory_In_Month"><div class="ew-table-header-caption"><?php echo $tbl_inventory->In_Month->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="In_Month" class="<?php echo $tbl_inventory->In_Month->headerCellClass() ?>" style="width: 20px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_inventory->SortUrl($tbl_inventory->In_Month) ?>',2);"><div id="elh_tbl_inventory_In_Month" class="tbl_inventory_In_Month">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_inventory->In_Month->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_inventory->In_Month->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_inventory->In_Month->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_inventory->Code->Visible) { // Code ?>
	<?php if ($tbl_inventory->sortUrl($tbl_inventory->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_inventory->Code->headerCellClass() ?>" style="width: 100px; white-space: nowrap;"><div id="elh_tbl_inventory_Code" class="tbl_inventory_Code"><div class="ew-table-header-caption"><?php echo $tbl_inventory->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_inventory->Code->headerCellClass() ?>" style="width: 100px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_inventory->SortUrl($tbl_inventory->Code) ?>',2);"><div id="elh_tbl_inventory_Code" class="tbl_inventory_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_inventory->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_inventory->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_inventory->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_inventory->ProductName->Visible) { // ProductName ?>
	<?php if ($tbl_inventory->sortUrl($tbl_inventory->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $tbl_inventory->ProductName->headerCellClass() ?>" style="width: 250px; white-space: nowrap;"><div id="elh_tbl_inventory_ProductName" class="tbl_inventory_ProductName"><div class="ew-table-header-caption"><?php echo $tbl_inventory->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $tbl_inventory->ProductName->headerCellClass() ?>" style="width: 250px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_inventory->SortUrl($tbl_inventory->ProductName) ?>',2);"><div id="elh_tbl_inventory_ProductName" class="tbl_inventory_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_inventory->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_inventory->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_inventory->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_inventory->TypeName->Visible) { // TypeName ?>
	<?php if ($tbl_inventory->sortUrl($tbl_inventory->TypeName) == "") { ?>
		<th data-name="TypeName" class="<?php echo $tbl_inventory->TypeName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_inventory_TypeName" class="tbl_inventory_TypeName"><div class="ew-table-header-caption"><?php echo $tbl_inventory->TypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TypeName" class="<?php echo $tbl_inventory->TypeName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_inventory->SortUrl($tbl_inventory->TypeName) ?>',2);"><div id="elh_tbl_inventory_TypeName" class="tbl_inventory_TypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_inventory->TypeName->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_inventory->TypeName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_inventory->TypeName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_inventory->OpeningStock->Visible) { // OpeningStock ?>
	<?php if ($tbl_inventory->sortUrl($tbl_inventory->OpeningStock) == "") { ?>
		<th data-name="OpeningStock" class="<?php echo $tbl_inventory->OpeningStock->headerCellClass() ?>" style="width: 10px; white-space: nowrap;"><div id="elh_tbl_inventory_OpeningStock" class="tbl_inventory_OpeningStock"><div class="ew-table-header-caption"><?php echo $tbl_inventory->OpeningStock->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OpeningStock" class="<?php echo $tbl_inventory->OpeningStock->headerCellClass() ?>" style="width: 10px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_inventory->SortUrl($tbl_inventory->OpeningStock) ?>',2);"><div id="elh_tbl_inventory_OpeningStock" class="tbl_inventory_OpeningStock">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_inventory->OpeningStock->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_inventory->OpeningStock->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_inventory->OpeningStock->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_inventory->PCS_IN->Visible) { // PCS_IN ?>
	<?php if ($tbl_inventory->sortUrl($tbl_inventory->PCS_IN) == "") { ?>
		<th data-name="PCS_IN" class="<?php echo $tbl_inventory->PCS_IN->headerCellClass() ?>" style="width: 10px; white-space: nowrap;"><div id="elh_tbl_inventory_PCS_IN" class="tbl_inventory_PCS_IN"><div class="ew-table-header-caption"><?php echo $tbl_inventory->PCS_IN->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_IN" class="<?php echo $tbl_inventory->PCS_IN->headerCellClass() ?>" style="width: 10px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_inventory->SortUrl($tbl_inventory->PCS_IN) ?>',2);"><div id="elh_tbl_inventory_PCS_IN" class="tbl_inventory_PCS_IN">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_inventory->PCS_IN->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_inventory->PCS_IN->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_inventory->PCS_IN->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_inventory->PCS_OUT->Visible) { // PCS_OUT ?>
	<?php if ($tbl_inventory->sortUrl($tbl_inventory->PCS_OUT) == "") { ?>
		<th data-name="PCS_OUT" class="<?php echo $tbl_inventory->PCS_OUT->headerCellClass() ?>" style="width: 10px; white-space: nowrap;"><div id="elh_tbl_inventory_PCS_OUT" class="tbl_inventory_PCS_OUT"><div class="ew-table-header-caption"><?php echo $tbl_inventory->PCS_OUT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_OUT" class="<?php echo $tbl_inventory->PCS_OUT->headerCellClass() ?>" style="width: 10px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_inventory->SortUrl($tbl_inventory->PCS_OUT) ?>',2);"><div id="elh_tbl_inventory_PCS_OUT" class="tbl_inventory_PCS_OUT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_inventory->PCS_OUT->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_inventory->PCS_OUT->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_inventory->PCS_OUT->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_inventory->ClosingStock->Visible) { // ClosingStock ?>
	<?php if ($tbl_inventory->sortUrl($tbl_inventory->ClosingStock) == "") { ?>
		<th data-name="ClosingStock" class="<?php echo $tbl_inventory->ClosingStock->headerCellClass() ?>" style="width: 10px; white-space: nowrap;"><div id="elh_tbl_inventory_ClosingStock" class="tbl_inventory_ClosingStock"><div class="ew-table-header-caption"><?php echo $tbl_inventory->ClosingStock->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClosingStock" class="<?php echo $tbl_inventory->ClosingStock->headerCellClass() ?>" style="width: 10px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_inventory->SortUrl($tbl_inventory->ClosingStock) ?>',2);"><div id="elh_tbl_inventory_ClosingStock" class="tbl_inventory_ClosingStock">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_inventory->ClosingStock->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_inventory->ClosingStock->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_inventory->ClosingStock->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_inventory->LockStock->Visible) { // LockStock ?>
	<?php if ($tbl_inventory->sortUrl($tbl_inventory->LockStock) == "") { ?>
		<th data-name="LockStock" class="<?php echo $tbl_inventory->LockStock->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_inventory_LockStock" class="tbl_inventory_LockStock"><div class="ew-table-header-caption"><?php echo $tbl_inventory->LockStock->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LockStock" class="<?php echo $tbl_inventory->LockStock->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_inventory->SortUrl($tbl_inventory->LockStock) ?>',2);"><div id="elh_tbl_inventory_LockStock" class="tbl_inventory_LockStock">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_inventory->LockStock->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_inventory->LockStock->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_inventory->LockStock->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_inventory_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_inventory->ExportAll && $tbl_inventory->isExport()) {
	$tbl_inventory_list->StopRec = $tbl_inventory_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_inventory_list->TotalRecs > $tbl_inventory_list->StartRec + $tbl_inventory_list->DisplayRecs - 1)
		$tbl_inventory_list->StopRec = $tbl_inventory_list->StartRec + $tbl_inventory_list->DisplayRecs - 1;
	else
		$tbl_inventory_list->StopRec = $tbl_inventory_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $tbl_inventory_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_inventory_list->FormKeyCountName) && ($tbl_inventory->isGridAdd() || $tbl_inventory->isGridEdit() || $tbl_inventory->isConfirm())) {
		$tbl_inventory_list->KeyCount = $CurrentForm->getValue($tbl_inventory_list->FormKeyCountName);
		$tbl_inventory_list->StopRec = $tbl_inventory_list->StartRec + $tbl_inventory_list->KeyCount - 1;
	}
}
$tbl_inventory_list->RecCnt = $tbl_inventory_list->StartRec - 1;
if ($tbl_inventory_list->Recordset && !$tbl_inventory_list->Recordset->EOF) {
	$tbl_inventory_list->Recordset->moveFirst();
	$selectLimit = $tbl_inventory_list->UseSelectLimit;
	if (!$selectLimit && $tbl_inventory_list->StartRec > 1)
		$tbl_inventory_list->Recordset->move($tbl_inventory_list->StartRec - 1);
} elseif (!$tbl_inventory->AllowAddDeleteRow && $tbl_inventory_list->StopRec == 0) {
	$tbl_inventory_list->StopRec = $tbl_inventory->GridAddRowCount;
}

// Initialize aggregate
$tbl_inventory->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_inventory->resetAttributes();
$tbl_inventory_list->renderRow();
if ($tbl_inventory->isGridEdit())
	$tbl_inventory_list->RowIndex = 0;
while ($tbl_inventory_list->RecCnt < $tbl_inventory_list->StopRec) {
	$tbl_inventory_list->RecCnt++;
	if ($tbl_inventory_list->RecCnt >= $tbl_inventory_list->StartRec) {
		$tbl_inventory_list->RowCnt++;
		if ($tbl_inventory->isGridAdd() || $tbl_inventory->isGridEdit() || $tbl_inventory->isConfirm()) {
			$tbl_inventory_list->RowIndex++;
			$CurrentForm->Index = $tbl_inventory_list->RowIndex;
			if ($CurrentForm->hasValue($tbl_inventory_list->FormActionName) && $tbl_inventory_list->EventCancelled)
				$tbl_inventory_list->RowAction = strval($CurrentForm->getValue($tbl_inventory_list->FormActionName));
			elseif ($tbl_inventory->isGridAdd())
				$tbl_inventory_list->RowAction = "insert";
			else
				$tbl_inventory_list->RowAction = "";
		}

		// Set up key count
		$tbl_inventory_list->KeyCount = $tbl_inventory_list->RowIndex;

		// Init row class and style
		$tbl_inventory->resetAttributes();
		$tbl_inventory->CssClass = "";
		if ($tbl_inventory->isGridAdd()) {
			$tbl_inventory_list->loadRowValues(); // Load default values
		} else {
			$tbl_inventory_list->loadRowValues($tbl_inventory_list->Recordset); // Load row values
		}
		$tbl_inventory->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_inventory->isGridEdit()) { // Grid edit
			if ($tbl_inventory->EventCancelled)
				$tbl_inventory_list->restoreCurrentRowFormValues($tbl_inventory_list->RowIndex); // Restore form values
			if ($tbl_inventory_list->RowAction == "insert")
				$tbl_inventory->RowType = ROWTYPE_ADD; // Render add
			else
				$tbl_inventory->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_inventory->isGridEdit() && ($tbl_inventory->RowType == ROWTYPE_EDIT || $tbl_inventory->RowType == ROWTYPE_ADD) && $tbl_inventory->EventCancelled) // Update failed
			$tbl_inventory_list->restoreCurrentRowFormValues($tbl_inventory_list->RowIndex); // Restore form values
		if ($tbl_inventory->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_inventory_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$tbl_inventory->RowAttrs = array_merge($tbl_inventory->RowAttrs, array('data-rowindex'=>$tbl_inventory_list->RowCnt, 'id'=>'r' . $tbl_inventory_list->RowCnt . '_tbl_inventory', 'data-rowtype'=>$tbl_inventory->RowType));

		// Render row
		$tbl_inventory_list->renderRow();

		// Render list options
		$tbl_inventory_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_inventory_list->RowAction <> "delete" && $tbl_inventory_list->RowAction <> "insertdelete" && !($tbl_inventory_list->RowAction == "insert" && $tbl_inventory->isConfirm() && $tbl_inventory_list->emptyRow())) {
?>
	<tr<?php echo $tbl_inventory->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_inventory_list->ListOptions->render("body", "left", $tbl_inventory_list->RowCnt);
?>
	<?php if ($tbl_inventory->In_Year->Visible) { // In_Year ?>
		<td data-name="In_Year"<?php echo $tbl_inventory->In_Year->cellAttributes() ?>>
<?php if ($tbl_inventory->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_In_Year" class="form-group tbl_inventory_In_Year">
<input type="text" data-table="tbl_inventory" data-field="x_In_Year" name="x<?php echo $tbl_inventory_list->RowIndex ?>_In_Year" id="x<?php echo $tbl_inventory_list->RowIndex ?>_In_Year" size="10" placeholder="<?php echo HtmlEncode($tbl_inventory->In_Year->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->In_Year->EditValue ?>"<?php echo $tbl_inventory->In_Year->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_In_Year" name="o<?php echo $tbl_inventory_list->RowIndex ?>_In_Year" id="o<?php echo $tbl_inventory_list->RowIndex ?>_In_Year" value="<?php echo HtmlEncode($tbl_inventory->In_Year->OldValue) ?>">
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_In_Year" class="form-group tbl_inventory_In_Year">
<span<?php echo $tbl_inventory->In_Year->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_inventory->In_Year->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_In_Year" name="x<?php echo $tbl_inventory_list->RowIndex ?>_In_Year" id="x<?php echo $tbl_inventory_list->RowIndex ?>_In_Year" value="<?php echo HtmlEncode($tbl_inventory->In_Year->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_In_Year" class="tbl_inventory_In_Year">
<span<?php echo $tbl_inventory->In_Year->viewAttributes() ?>>
<?php echo $tbl_inventory->In_Year->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_inventory" data-field="x_ID_Delivery" name="x<?php echo $tbl_inventory_list->RowIndex ?>_ID_Delivery" id="x<?php echo $tbl_inventory_list->RowIndex ?>_ID_Delivery" value="<?php echo HtmlEncode($tbl_inventory->ID_Delivery->CurrentValue) ?>">
<input type="hidden" data-table="tbl_inventory" data-field="x_ID_Delivery" name="o<?php echo $tbl_inventory_list->RowIndex ?>_ID_Delivery" id="o<?php echo $tbl_inventory_list->RowIndex ?>_ID_Delivery" value="<?php echo HtmlEncode($tbl_inventory->ID_Delivery->OldValue) ?>">
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_EDIT || $tbl_inventory->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_inventory" data-field="x_ID_Delivery" name="x<?php echo $tbl_inventory_list->RowIndex ?>_ID_Delivery" id="x<?php echo $tbl_inventory_list->RowIndex ?>_ID_Delivery" value="<?php echo HtmlEncode($tbl_inventory->ID_Delivery->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_inventory->In_Month->Visible) { // In_Month ?>
		<td data-name="In_Month"<?php echo $tbl_inventory->In_Month->cellAttributes() ?>>
<?php if ($tbl_inventory->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_In_Month" class="form-group tbl_inventory_In_Month">
<input type="text" data-table="tbl_inventory" data-field="x_In_Month" name="x<?php echo $tbl_inventory_list->RowIndex ?>_In_Month" id="x<?php echo $tbl_inventory_list->RowIndex ?>_In_Month" size="5" placeholder="<?php echo HtmlEncode($tbl_inventory->In_Month->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->In_Month->EditValue ?>"<?php echo $tbl_inventory->In_Month->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_In_Month" name="o<?php echo $tbl_inventory_list->RowIndex ?>_In_Month" id="o<?php echo $tbl_inventory_list->RowIndex ?>_In_Month" value="<?php echo HtmlEncode($tbl_inventory->In_Month->OldValue) ?>">
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_In_Month" class="form-group tbl_inventory_In_Month">
<span<?php echo $tbl_inventory->In_Month->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_inventory->In_Month->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_In_Month" name="x<?php echo $tbl_inventory_list->RowIndex ?>_In_Month" id="x<?php echo $tbl_inventory_list->RowIndex ?>_In_Month" value="<?php echo HtmlEncode($tbl_inventory->In_Month->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_In_Month" class="tbl_inventory_In_Month">
<span<?php echo $tbl_inventory->In_Month->viewAttributes() ?>>
<?php echo $tbl_inventory->In_Month->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_inventory->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_inventory->Code->cellAttributes() ?>>
<?php if ($tbl_inventory->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_Code" class="form-group tbl_inventory_Code">
<input type="text" data-table="tbl_inventory" data-field="x_Code" name="x<?php echo $tbl_inventory_list->RowIndex ?>_Code" id="x<?php echo $tbl_inventory_list->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_inventory->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->Code->EditValue ?>"<?php echo $tbl_inventory->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_Code" name="o<?php echo $tbl_inventory_list->RowIndex ?>_Code" id="o<?php echo $tbl_inventory_list->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_inventory->Code->OldValue) ?>">
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_Code" class="form-group tbl_inventory_Code">
<span<?php echo $tbl_inventory->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_inventory->Code->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_Code" name="x<?php echo $tbl_inventory_list->RowIndex ?>_Code" id="x<?php echo $tbl_inventory_list->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_inventory->Code->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_Code" class="tbl_inventory_Code">
<span<?php echo $tbl_inventory->Code->viewAttributes() ?>>
<?php echo $tbl_inventory->Code->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_inventory->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $tbl_inventory->ProductName->cellAttributes() ?>>
<?php if ($tbl_inventory->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_ProductName" class="form-group tbl_inventory_ProductName">
<input type="text" data-table="tbl_inventory" data-field="x_ProductName" name="x<?php echo $tbl_inventory_list->RowIndex ?>_ProductName" id="x<?php echo $tbl_inventory_list->RowIndex ?>_ProductName" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($tbl_inventory->ProductName->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->ProductName->EditValue ?>"<?php echo $tbl_inventory->ProductName->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_ProductName" name="o<?php echo $tbl_inventory_list->RowIndex ?>_ProductName" id="o<?php echo $tbl_inventory_list->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_inventory->ProductName->OldValue) ?>">
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_ProductName" class="form-group tbl_inventory_ProductName">
<span<?php echo $tbl_inventory->ProductName->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_inventory->ProductName->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_ProductName" name="x<?php echo $tbl_inventory_list->RowIndex ?>_ProductName" id="x<?php echo $tbl_inventory_list->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_inventory->ProductName->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_ProductName" class="tbl_inventory_ProductName">
<span<?php echo $tbl_inventory->ProductName->viewAttributes() ?>>
<?php echo $tbl_inventory->ProductName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_inventory->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName"<?php echo $tbl_inventory->TypeName->cellAttributes() ?>>
<?php if ($tbl_inventory->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_TypeName" class="form-group tbl_inventory_TypeName">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_TypeName" data-value-separator="<?php echo $tbl_inventory->TypeName->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_inventory_list->RowIndex ?>_TypeName" name="x<?php echo $tbl_inventory_list->RowIndex ?>_TypeName"<?php echo $tbl_inventory->TypeName->editAttributes() ?>>
		<?php echo $tbl_inventory->TypeName->selectOptionListHtml("x<?php echo $tbl_inventory_list->RowIndex ?>_TypeName") ?>
	</select>
</div>
<?php echo $tbl_inventory->TypeName->Lookup->getParamTag("p_x" . $tbl_inventory_list->RowIndex . "_TypeName") ?>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_TypeName" name="o<?php echo $tbl_inventory_list->RowIndex ?>_TypeName" id="o<?php echo $tbl_inventory_list->RowIndex ?>_TypeName" value="<?php echo HtmlEncode($tbl_inventory->TypeName->OldValue) ?>">
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_TypeName" class="form-group tbl_inventory_TypeName">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_TypeName" data-value-separator="<?php echo $tbl_inventory->TypeName->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_inventory_list->RowIndex ?>_TypeName" name="x<?php echo $tbl_inventory_list->RowIndex ?>_TypeName"<?php echo $tbl_inventory->TypeName->editAttributes() ?>>
		<?php echo $tbl_inventory->TypeName->selectOptionListHtml("x<?php echo $tbl_inventory_list->RowIndex ?>_TypeName") ?>
	</select>
</div>
<?php echo $tbl_inventory->TypeName->Lookup->getParamTag("p_x" . $tbl_inventory_list->RowIndex . "_TypeName") ?>
</span>
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_TypeName" class="tbl_inventory_TypeName">
<span<?php echo $tbl_inventory->TypeName->viewAttributes() ?>>
<?php echo $tbl_inventory->TypeName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_inventory->OpeningStock->Visible) { // OpeningStock ?>
		<td data-name="OpeningStock"<?php echo $tbl_inventory->OpeningStock->cellAttributes() ?>>
<?php if ($tbl_inventory->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_OpeningStock" class="form-group tbl_inventory_OpeningStock">
<input type="text" data-table="tbl_inventory" data-field="x_OpeningStock" name="x<?php echo $tbl_inventory_list->RowIndex ?>_OpeningStock" id="x<?php echo $tbl_inventory_list->RowIndex ?>_OpeningStock" size="5" placeholder="<?php echo HtmlEncode($tbl_inventory->OpeningStock->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->OpeningStock->EditValue ?>"<?php echo $tbl_inventory->OpeningStock->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_OpeningStock" name="o<?php echo $tbl_inventory_list->RowIndex ?>_OpeningStock" id="o<?php echo $tbl_inventory_list->RowIndex ?>_OpeningStock" value="<?php echo HtmlEncode($tbl_inventory->OpeningStock->OldValue) ?>">
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_OpeningStock" class="form-group tbl_inventory_OpeningStock">
<span<?php echo $tbl_inventory->OpeningStock->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_inventory->OpeningStock->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_OpeningStock" name="x<?php echo $tbl_inventory_list->RowIndex ?>_OpeningStock" id="x<?php echo $tbl_inventory_list->RowIndex ?>_OpeningStock" value="<?php echo HtmlEncode($tbl_inventory->OpeningStock->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_OpeningStock" class="tbl_inventory_OpeningStock">
<span<?php echo $tbl_inventory->OpeningStock->viewAttributes() ?>>
<?php echo $tbl_inventory->OpeningStock->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_inventory->PCS_IN->Visible) { // PCS_IN ?>
		<td data-name="PCS_IN"<?php echo $tbl_inventory->PCS_IN->cellAttributes() ?>>
<?php if ($tbl_inventory->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_PCS_IN" class="form-group tbl_inventory_PCS_IN">
<input type="text" data-table="tbl_inventory" data-field="x_PCS_IN" name="x<?php echo $tbl_inventory_list->RowIndex ?>_PCS_IN" id="x<?php echo $tbl_inventory_list->RowIndex ?>_PCS_IN" size="5" placeholder="<?php echo HtmlEncode($tbl_inventory->PCS_IN->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->PCS_IN->EditValue ?>"<?php echo $tbl_inventory->PCS_IN->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_PCS_IN" name="o<?php echo $tbl_inventory_list->RowIndex ?>_PCS_IN" id="o<?php echo $tbl_inventory_list->RowIndex ?>_PCS_IN" value="<?php echo HtmlEncode($tbl_inventory->PCS_IN->OldValue) ?>">
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_PCS_IN" class="form-group tbl_inventory_PCS_IN">
<span<?php echo $tbl_inventory->PCS_IN->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_inventory->PCS_IN->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_PCS_IN" name="x<?php echo $tbl_inventory_list->RowIndex ?>_PCS_IN" id="x<?php echo $tbl_inventory_list->RowIndex ?>_PCS_IN" value="<?php echo HtmlEncode($tbl_inventory->PCS_IN->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_PCS_IN" class="tbl_inventory_PCS_IN">
<span<?php echo $tbl_inventory->PCS_IN->viewAttributes() ?>>
<?php echo $tbl_inventory->PCS_IN->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_inventory->PCS_OUT->Visible) { // PCS_OUT ?>
		<td data-name="PCS_OUT"<?php echo $tbl_inventory->PCS_OUT->cellAttributes() ?>>
<?php if ($tbl_inventory->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_PCS_OUT" class="form-group tbl_inventory_PCS_OUT">
<input type="text" data-table="tbl_inventory" data-field="x_PCS_OUT" name="x<?php echo $tbl_inventory_list->RowIndex ?>_PCS_OUT" id="x<?php echo $tbl_inventory_list->RowIndex ?>_PCS_OUT" size="5" placeholder="<?php echo HtmlEncode($tbl_inventory->PCS_OUT->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->PCS_OUT->EditValue ?>"<?php echo $tbl_inventory->PCS_OUT->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_PCS_OUT" name="o<?php echo $tbl_inventory_list->RowIndex ?>_PCS_OUT" id="o<?php echo $tbl_inventory_list->RowIndex ?>_PCS_OUT" value="<?php echo HtmlEncode($tbl_inventory->PCS_OUT->OldValue) ?>">
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_PCS_OUT" class="form-group tbl_inventory_PCS_OUT">
<span<?php echo $tbl_inventory->PCS_OUT->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_inventory->PCS_OUT->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_PCS_OUT" name="x<?php echo $tbl_inventory_list->RowIndex ?>_PCS_OUT" id="x<?php echo $tbl_inventory_list->RowIndex ?>_PCS_OUT" value="<?php echo HtmlEncode($tbl_inventory->PCS_OUT->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_PCS_OUT" class="tbl_inventory_PCS_OUT">
<span<?php echo $tbl_inventory->PCS_OUT->viewAttributes() ?>>
<?php echo $tbl_inventory->PCS_OUT->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_inventory->ClosingStock->Visible) { // ClosingStock ?>
		<td data-name="ClosingStock"<?php echo $tbl_inventory->ClosingStock->cellAttributes() ?>>
<?php if ($tbl_inventory->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_ClosingStock" class="form-group tbl_inventory_ClosingStock">
<input type="text" data-table="tbl_inventory" data-field="x_ClosingStock" name="x<?php echo $tbl_inventory_list->RowIndex ?>_ClosingStock" id="x<?php echo $tbl_inventory_list->RowIndex ?>_ClosingStock" size="5" placeholder="<?php echo HtmlEncode($tbl_inventory->ClosingStock->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->ClosingStock->EditValue ?>"<?php echo $tbl_inventory->ClosingStock->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_ClosingStock" name="o<?php echo $tbl_inventory_list->RowIndex ?>_ClosingStock" id="o<?php echo $tbl_inventory_list->RowIndex ?>_ClosingStock" value="<?php echo HtmlEncode($tbl_inventory->ClosingStock->OldValue) ?>">
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_ClosingStock" class="form-group tbl_inventory_ClosingStock">
<span<?php echo $tbl_inventory->ClosingStock->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_inventory->ClosingStock->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_ClosingStock" name="x<?php echo $tbl_inventory_list->RowIndex ?>_ClosingStock" id="x<?php echo $tbl_inventory_list->RowIndex ?>_ClosingStock" value="<?php echo HtmlEncode($tbl_inventory->ClosingStock->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_ClosingStock" class="tbl_inventory_ClosingStock">
<span<?php echo $tbl_inventory->ClosingStock->viewAttributes() ?>>
<?php echo $tbl_inventory->ClosingStock->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_inventory->LockStock->Visible) { // LockStock ?>
		<td data-name="LockStock"<?php echo $tbl_inventory->LockStock->cellAttributes() ?>>
<?php if ($tbl_inventory->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_LockStock" class="form-group tbl_inventory_LockStock">
<div id="tp_x<?php echo $tbl_inventory_list->RowIndex ?>_LockStock" class="ew-template"><input type="radio" class="form-check-input" data-table="tbl_inventory" data-field="x_LockStock" data-value-separator="<?php echo $tbl_inventory->LockStock->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_inventory_list->RowIndex ?>_LockStock" id="x<?php echo $tbl_inventory_list->RowIndex ?>_LockStock" value="{value}"<?php echo $tbl_inventory->LockStock->editAttributes() ?>></div>
<div id="dsl_x<?php echo $tbl_inventory_list->RowIndex ?>_LockStock" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $tbl_inventory->LockStock->radioButtonListHtml(FALSE, "x{$tbl_inventory_list->RowIndex}_LockStock") ?>
</div></div>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_LockStock" name="o<?php echo $tbl_inventory_list->RowIndex ?>_LockStock" id="o<?php echo $tbl_inventory_list->RowIndex ?>_LockStock" value="<?php echo HtmlEncode($tbl_inventory->LockStock->OldValue) ?>">
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_LockStock" class="form-group tbl_inventory_LockStock">
<div id="tp_x<?php echo $tbl_inventory_list->RowIndex ?>_LockStock" class="ew-template"><input type="radio" class="form-check-input" data-table="tbl_inventory" data-field="x_LockStock" data-value-separator="<?php echo $tbl_inventory->LockStock->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_inventory_list->RowIndex ?>_LockStock" id="x<?php echo $tbl_inventory_list->RowIndex ?>_LockStock" value="{value}"<?php echo $tbl_inventory->LockStock->editAttributes() ?>></div>
<div id="dsl_x<?php echo $tbl_inventory_list->RowIndex ?>_LockStock" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $tbl_inventory->LockStock->radioButtonListHtml(FALSE, "x{$tbl_inventory_list->RowIndex}_LockStock") ?>
</div></div>
</span>
<?php } ?>
<?php if ($tbl_inventory->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_inventory_list->RowCnt ?>_tbl_inventory_LockStock" class="tbl_inventory_LockStock">
<span<?php echo $tbl_inventory->LockStock->viewAttributes() ?>>
<?php echo $tbl_inventory->LockStock->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_inventory_list->ListOptions->render("body", "right", $tbl_inventory_list->RowCnt);
?>
	</tr>
<?php if ($tbl_inventory->RowType == ROWTYPE_ADD || $tbl_inventory->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_inventorylist.updateLists(<?php echo $tbl_inventory_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$tbl_inventory->isGridAdd())
		if (!$tbl_inventory_list->Recordset->EOF)
			$tbl_inventory_list->Recordset->moveNext();
}
?>
<?php
	if ($tbl_inventory->isGridAdd() || $tbl_inventory->isGridEdit()) {
		$tbl_inventory_list->RowIndex = '$rowindex$';
		$tbl_inventory_list->loadRowValues();

		// Set row properties
		$tbl_inventory->resetAttributes();
		$tbl_inventory->RowAttrs = array_merge($tbl_inventory->RowAttrs, array('data-rowindex'=>$tbl_inventory_list->RowIndex, 'id'=>'r0_tbl_inventory', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($tbl_inventory->RowAttrs["class"], "ew-template");
		$tbl_inventory->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_inventory_list->renderRow();

		// Render list options
		$tbl_inventory_list->renderListOptions();
		$tbl_inventory_list->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_inventory->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_inventory_list->ListOptions->render("body", "left", $tbl_inventory_list->RowIndex);
?>
	<?php if ($tbl_inventory->In_Year->Visible) { // In_Year ?>
		<td data-name="In_Year">
<span id="el$rowindex$_tbl_inventory_In_Year" class="form-group tbl_inventory_In_Year">
<input type="text" data-table="tbl_inventory" data-field="x_In_Year" name="x<?php echo $tbl_inventory_list->RowIndex ?>_In_Year" id="x<?php echo $tbl_inventory_list->RowIndex ?>_In_Year" size="10" placeholder="<?php echo HtmlEncode($tbl_inventory->In_Year->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->In_Year->EditValue ?>"<?php echo $tbl_inventory->In_Year->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_In_Year" name="o<?php echo $tbl_inventory_list->RowIndex ?>_In_Year" id="o<?php echo $tbl_inventory_list->RowIndex ?>_In_Year" value="<?php echo HtmlEncode($tbl_inventory->In_Year->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_inventory->In_Month->Visible) { // In_Month ?>
		<td data-name="In_Month">
<span id="el$rowindex$_tbl_inventory_In_Month" class="form-group tbl_inventory_In_Month">
<input type="text" data-table="tbl_inventory" data-field="x_In_Month" name="x<?php echo $tbl_inventory_list->RowIndex ?>_In_Month" id="x<?php echo $tbl_inventory_list->RowIndex ?>_In_Month" size="5" placeholder="<?php echo HtmlEncode($tbl_inventory->In_Month->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->In_Month->EditValue ?>"<?php echo $tbl_inventory->In_Month->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_In_Month" name="o<?php echo $tbl_inventory_list->RowIndex ?>_In_Month" id="o<?php echo $tbl_inventory_list->RowIndex ?>_In_Month" value="<?php echo HtmlEncode($tbl_inventory->In_Month->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_inventory->Code->Visible) { // Code ?>
		<td data-name="Code">
<span id="el$rowindex$_tbl_inventory_Code" class="form-group tbl_inventory_Code">
<input type="text" data-table="tbl_inventory" data-field="x_Code" name="x<?php echo $tbl_inventory_list->RowIndex ?>_Code" id="x<?php echo $tbl_inventory_list->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_inventory->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->Code->EditValue ?>"<?php echo $tbl_inventory->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_Code" name="o<?php echo $tbl_inventory_list->RowIndex ?>_Code" id="o<?php echo $tbl_inventory_list->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_inventory->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_inventory->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName">
<span id="el$rowindex$_tbl_inventory_ProductName" class="form-group tbl_inventory_ProductName">
<input type="text" data-table="tbl_inventory" data-field="x_ProductName" name="x<?php echo $tbl_inventory_list->RowIndex ?>_ProductName" id="x<?php echo $tbl_inventory_list->RowIndex ?>_ProductName" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($tbl_inventory->ProductName->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->ProductName->EditValue ?>"<?php echo $tbl_inventory->ProductName->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_ProductName" name="o<?php echo $tbl_inventory_list->RowIndex ?>_ProductName" id="o<?php echo $tbl_inventory_list->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_inventory->ProductName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_inventory->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName">
<span id="el$rowindex$_tbl_inventory_TypeName" class="form-group tbl_inventory_TypeName">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_TypeName" data-value-separator="<?php echo $tbl_inventory->TypeName->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_inventory_list->RowIndex ?>_TypeName" name="x<?php echo $tbl_inventory_list->RowIndex ?>_TypeName"<?php echo $tbl_inventory->TypeName->editAttributes() ?>>
		<?php echo $tbl_inventory->TypeName->selectOptionListHtml("x<?php echo $tbl_inventory_list->RowIndex ?>_TypeName") ?>
	</select>
</div>
<?php echo $tbl_inventory->TypeName->Lookup->getParamTag("p_x" . $tbl_inventory_list->RowIndex . "_TypeName") ?>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_TypeName" name="o<?php echo $tbl_inventory_list->RowIndex ?>_TypeName" id="o<?php echo $tbl_inventory_list->RowIndex ?>_TypeName" value="<?php echo HtmlEncode($tbl_inventory->TypeName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_inventory->OpeningStock->Visible) { // OpeningStock ?>
		<td data-name="OpeningStock">
<span id="el$rowindex$_tbl_inventory_OpeningStock" class="form-group tbl_inventory_OpeningStock">
<input type="text" data-table="tbl_inventory" data-field="x_OpeningStock" name="x<?php echo $tbl_inventory_list->RowIndex ?>_OpeningStock" id="x<?php echo $tbl_inventory_list->RowIndex ?>_OpeningStock" size="5" placeholder="<?php echo HtmlEncode($tbl_inventory->OpeningStock->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->OpeningStock->EditValue ?>"<?php echo $tbl_inventory->OpeningStock->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_OpeningStock" name="o<?php echo $tbl_inventory_list->RowIndex ?>_OpeningStock" id="o<?php echo $tbl_inventory_list->RowIndex ?>_OpeningStock" value="<?php echo HtmlEncode($tbl_inventory->OpeningStock->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_inventory->PCS_IN->Visible) { // PCS_IN ?>
		<td data-name="PCS_IN">
<span id="el$rowindex$_tbl_inventory_PCS_IN" class="form-group tbl_inventory_PCS_IN">
<input type="text" data-table="tbl_inventory" data-field="x_PCS_IN" name="x<?php echo $tbl_inventory_list->RowIndex ?>_PCS_IN" id="x<?php echo $tbl_inventory_list->RowIndex ?>_PCS_IN" size="5" placeholder="<?php echo HtmlEncode($tbl_inventory->PCS_IN->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->PCS_IN->EditValue ?>"<?php echo $tbl_inventory->PCS_IN->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_PCS_IN" name="o<?php echo $tbl_inventory_list->RowIndex ?>_PCS_IN" id="o<?php echo $tbl_inventory_list->RowIndex ?>_PCS_IN" value="<?php echo HtmlEncode($tbl_inventory->PCS_IN->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_inventory->PCS_OUT->Visible) { // PCS_OUT ?>
		<td data-name="PCS_OUT">
<span id="el$rowindex$_tbl_inventory_PCS_OUT" class="form-group tbl_inventory_PCS_OUT">
<input type="text" data-table="tbl_inventory" data-field="x_PCS_OUT" name="x<?php echo $tbl_inventory_list->RowIndex ?>_PCS_OUT" id="x<?php echo $tbl_inventory_list->RowIndex ?>_PCS_OUT" size="5" placeholder="<?php echo HtmlEncode($tbl_inventory->PCS_OUT->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->PCS_OUT->EditValue ?>"<?php echo $tbl_inventory->PCS_OUT->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_PCS_OUT" name="o<?php echo $tbl_inventory_list->RowIndex ?>_PCS_OUT" id="o<?php echo $tbl_inventory_list->RowIndex ?>_PCS_OUT" value="<?php echo HtmlEncode($tbl_inventory->PCS_OUT->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_inventory->ClosingStock->Visible) { // ClosingStock ?>
		<td data-name="ClosingStock">
<span id="el$rowindex$_tbl_inventory_ClosingStock" class="form-group tbl_inventory_ClosingStock">
<input type="text" data-table="tbl_inventory" data-field="x_ClosingStock" name="x<?php echo $tbl_inventory_list->RowIndex ?>_ClosingStock" id="x<?php echo $tbl_inventory_list->RowIndex ?>_ClosingStock" size="5" placeholder="<?php echo HtmlEncode($tbl_inventory->ClosingStock->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->ClosingStock->EditValue ?>"<?php echo $tbl_inventory->ClosingStock->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_ClosingStock" name="o<?php echo $tbl_inventory_list->RowIndex ?>_ClosingStock" id="o<?php echo $tbl_inventory_list->RowIndex ?>_ClosingStock" value="<?php echo HtmlEncode($tbl_inventory->ClosingStock->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_inventory->LockStock->Visible) { // LockStock ?>
		<td data-name="LockStock">
<span id="el$rowindex$_tbl_inventory_LockStock" class="form-group tbl_inventory_LockStock">
<div id="tp_x<?php echo $tbl_inventory_list->RowIndex ?>_LockStock" class="ew-template"><input type="radio" class="form-check-input" data-table="tbl_inventory" data-field="x_LockStock" data-value-separator="<?php echo $tbl_inventory->LockStock->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_inventory_list->RowIndex ?>_LockStock" id="x<?php echo $tbl_inventory_list->RowIndex ?>_LockStock" value="{value}"<?php echo $tbl_inventory->LockStock->editAttributes() ?>></div>
<div id="dsl_x<?php echo $tbl_inventory_list->RowIndex ?>_LockStock" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $tbl_inventory->LockStock->radioButtonListHtml(FALSE, "x{$tbl_inventory_list->RowIndex}_LockStock") ?>
</div></div>
</span>
<input type="hidden" data-table="tbl_inventory" data-field="x_LockStock" name="o<?php echo $tbl_inventory_list->RowIndex ?>_LockStock" id="o<?php echo $tbl_inventory_list->RowIndex ?>_LockStock" value="<?php echo HtmlEncode($tbl_inventory->LockStock->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_inventory_list->ListOptions->render("body", "right", $tbl_inventory_list->RowIndex);
?>
<script>
ftbl_inventorylist.updateLists(<?php echo $tbl_inventory_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
<?php

// Render aggregate row
$tbl_inventory->RowType = ROWTYPE_AGGREGATE;
$tbl_inventory->resetAttributes();
$tbl_inventory_list->renderRow();
?>
<?php if ($tbl_inventory_list->TotalRecs > 0 && !$tbl_inventory->isGridAdd() && !$tbl_inventory->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$tbl_inventory_list->renderListOptions();

// Render list options (footer, left)
$tbl_inventory_list->ListOptions->render("footer", "left");
?>
	<?php if ($tbl_inventory->In_Year->Visible) { // In_Year ?>
		<td data-name="In_Year" class="<?php echo $tbl_inventory->In_Year->footerCellClass() ?>"><span id="elf_tbl_inventory_In_Year" class="tbl_inventory_In_Year">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_inventory->In_Month->Visible) { // In_Month ?>
		<td data-name="In_Month" class="<?php echo $tbl_inventory->In_Month->footerCellClass() ?>"><span id="elf_tbl_inventory_In_Month" class="tbl_inventory_In_Month">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_inventory->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $tbl_inventory->Code->footerCellClass() ?>"><span id="elf_tbl_inventory_Code" class="tbl_inventory_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_inventory->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" class="<?php echo $tbl_inventory->ProductName->footerCellClass() ?>"><span id="elf_tbl_inventory_ProductName" class="tbl_inventory_ProductName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_inventory->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName" class="<?php echo $tbl_inventory->TypeName->footerCellClass() ?>"><span id="elf_tbl_inventory_TypeName" class="tbl_inventory_TypeName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_inventory->OpeningStock->Visible) { // OpeningStock ?>
		<td data-name="OpeningStock" class="<?php echo $tbl_inventory->OpeningStock->footerCellClass() ?>"><span id="elf_tbl_inventory_OpeningStock" class="tbl_inventory_OpeningStock">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_inventory->OpeningStock->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($tbl_inventory->PCS_IN->Visible) { // PCS_IN ?>
		<td data-name="PCS_IN" class="<?php echo $tbl_inventory->PCS_IN->footerCellClass() ?>"><span id="elf_tbl_inventory_PCS_IN" class="tbl_inventory_PCS_IN">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_inventory->PCS_IN->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($tbl_inventory->PCS_OUT->Visible) { // PCS_OUT ?>
		<td data-name="PCS_OUT" class="<?php echo $tbl_inventory->PCS_OUT->footerCellClass() ?>"><span id="elf_tbl_inventory_PCS_OUT" class="tbl_inventory_PCS_OUT">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_inventory->PCS_OUT->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($tbl_inventory->ClosingStock->Visible) { // ClosingStock ?>
		<td data-name="ClosingStock" class="<?php echo $tbl_inventory->ClosingStock->footerCellClass() ?>"><span id="elf_tbl_inventory_ClosingStock" class="tbl_inventory_ClosingStock">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_inventory->ClosingStock->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($tbl_inventory->LockStock->Visible) { // LockStock ?>
		<td data-name="LockStock" class="<?php echo $tbl_inventory->LockStock->footerCellClass() ?>"><span id="elf_tbl_inventory_LockStock" class="tbl_inventory_LockStock">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$tbl_inventory_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($tbl_inventory->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $tbl_inventory_list->FormKeyCountName ?>" id="<?php echo $tbl_inventory_list->FormKeyCountName ?>" value="<?php echo $tbl_inventory_list->KeyCount ?>">
<?php echo $tbl_inventory_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$tbl_inventory->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_inventory_list->Recordset)
	$tbl_inventory_list->Recordset->Close();
?>
<?php if (!$tbl_inventory->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_inventory->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_inventory_list->Pager)) $tbl_inventory_list->Pager = new PrevNextPager($tbl_inventory_list->StartRec, $tbl_inventory_list->DisplayRecs, $tbl_inventory_list->TotalRecs, $tbl_inventory_list->AutoHidePager) ?>
<?php if ($tbl_inventory_list->Pager->RecordCount > 0 && $tbl_inventory_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_inventory_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_inventory_list->pageUrl() ?>start=<?php echo $tbl_inventory_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_inventory_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_inventory_list->pageUrl() ?>start=<?php echo $tbl_inventory_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_inventory_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_inventory_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_inventory_list->pageUrl() ?>start=<?php echo $tbl_inventory_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_inventory_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_inventory_list->pageUrl() ?>start=<?php echo $tbl_inventory_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_inventory_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_inventory_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_inventory_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_inventory_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_inventory_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_inventory_list->TotalRecs > 0 && (!$tbl_inventory_list->AutoHidePageSizeSelector || $tbl_inventory_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_inventory">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_inventory_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_inventory_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_inventory_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_inventory_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_inventory_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="5000"<?php if ($tbl_inventory_list->DisplayRecs == 5000) { ?> selected<?php } ?>>5000</option>
<option value="ALL"<?php if ($tbl_inventory->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_inventory_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_inventory_list->TotalRecs == 0 && !$tbl_inventory->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_inventory_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_inventory_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_inventory->isExport()) { ?>
<script src="phpjs/js_enventory.js" type="text/javascript"></script>
<script>
$("#idprint").click(function(){		
		var allVals = [];										
		$('input[type="checkbox"]:checked').each(function () {													   
			allVals.push($(this).val()+'/');														   
		});
		var x="";
		for(var i=0;i<allVals.length;i++)
		{
			x+=allVals[i]; 
		}				
		window.location="rpt_OpeningClosing.php?id="+x.substring(0,x.length-1);
	});
$(".ew-excel").click(function(event){
		var allVals = [];										
		$('input[type="checkbox"]:checked').each(function () {													   
			allVals.push($(this).val()+'/');														   
		});
		var x="";
		for(var i=0;i<allVals.length;i++)
		{
			x+=allVals[i]; 
		}				
		window.location="rpt_OpeningClosing.php?id="+x.substring(0,x.length-1);
	});	
// Write your table-specific startup script here
// document.write("page loaded");
//$(".ew-btn-group").css("display","none");
</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_inventory_list->terminate();
?>