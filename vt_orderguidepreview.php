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
WriteHeader(FALSE, "utf-8");

// Create page object
$vt_orderguide_preview = new vt_orderguide_preview();

// Run the page
$vt_orderguide_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vt_orderguide_preview->Page_Render();
?>
<?php $vt_orderguide_preview->showPageHeader(); ?>
<div class="card ew-grid vt_orderguide"><!-- .card -->
<?php if ($vt_orderguide_preview->TotalRecs > 0) { ?>
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$vt_orderguide_preview->renderListOptions();

// Render list options (header, left)
$vt_orderguide_preview->ListOptions->render("header", "left");
?>
<?php if ($vt_orderguide->Code->Visible) { // Code ?>
	<?php if ($vt_orderguide->SortUrl($vt_orderguide->Code) == "") { ?>
		<th class="<?php echo $vt_orderguide->Code->headerCellClass() ?>"><?php echo $vt_orderguide->Code->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vt_orderguide->Code->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vt_orderguide->Code->Name ?>" data-sort-order="<?php echo $vt_orderguide_preview->SortField == $vt_orderguide->Code->Name && $vt_orderguide_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vt_orderguide->Code->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vt_orderguide_preview->SortField == $vt_orderguide->Code->Name) { ?><?php if ($vt_orderguide_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vt_orderguide_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vt_orderguide->ProductName->Visible) { // ProductName ?>
	<?php if ($vt_orderguide->SortUrl($vt_orderguide->ProductName) == "") { ?>
		<th class="<?php echo $vt_orderguide->ProductName->headerCellClass() ?>"><?php echo $vt_orderguide->ProductName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vt_orderguide->ProductName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vt_orderguide->ProductName->Name ?>" data-sort-order="<?php echo $vt_orderguide_preview->SortField == $vt_orderguide->ProductName->Name && $vt_orderguide_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vt_orderguide->ProductName->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vt_orderguide_preview->SortField == $vt_orderguide->ProductName->Name) { ?><?php if ($vt_orderguide_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vt_orderguide_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vt_orderguide->PCS->Visible) { // PCS ?>
	<?php if ($vt_orderguide->SortUrl($vt_orderguide->PCS) == "") { ?>
		<th class="<?php echo $vt_orderguide->PCS->headerCellClass() ?>"><?php echo $vt_orderguide->PCS->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vt_orderguide->PCS->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vt_orderguide->PCS->Name ?>" data-sort-order="<?php echo $vt_orderguide_preview->SortField == $vt_orderguide->PCS->Name && $vt_orderguide_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vt_orderguide->PCS->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vt_orderguide_preview->SortField == $vt_orderguide->PCS->Name) { ?><?php if ($vt_orderguide_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vt_orderguide_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vt_orderguide->Location->Visible) { // Location ?>
	<?php if ($vt_orderguide->SortUrl($vt_orderguide->Location) == "") { ?>
		<th class="<?php echo $vt_orderguide->Location->headerCellClass() ?>"><?php echo $vt_orderguide->Location->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vt_orderguide->Location->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vt_orderguide->Location->Name ?>" data-sort-order="<?php echo $vt_orderguide_preview->SortField == $vt_orderguide->Location->Name && $vt_orderguide_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vt_orderguide->Location->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vt_orderguide_preview->SortField == $vt_orderguide->Location->Name) { ?><?php if ($vt_orderguide_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vt_orderguide_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vt_orderguide_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$vt_orderguide_preview->RecCount = 0;
$vt_orderguide_preview->RowCnt = 0;
while ($vt_orderguide_preview->Recordset && !$vt_orderguide_preview->Recordset->EOF) {

	// Init row class and style
	$vt_orderguide_preview->RecCount++;
	$vt_orderguide_preview->RowCnt++;
	$vt_orderguide_preview->CssStyle = "";
	$vt_orderguide_preview->loadListRowValues($vt_orderguide_preview->Recordset);

	// Render row
	$vt_orderguide_preview->RowType = ROWTYPE_PREVIEW; // Preview record
	$vt_orderguide_preview->resetAttributes();
	$vt_orderguide_preview->renderListRow();

	// Render list options
	$vt_orderguide_preview->renderListOptions();
?>
	<tr<?php echo $vt_orderguide_preview->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vt_orderguide_preview->ListOptions->render("body", "left", $vt_orderguide_preview->RowCnt);
?>
<?php if ($vt_orderguide->Code->Visible) { // Code ?>
		<!-- Code -->
		<td<?php echo $vt_orderguide->Code->cellAttributes() ?>>
<span<?php echo $vt_orderguide->Code->viewAttributes() ?>>
<?php echo $vt_orderguide->Code->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vt_orderguide->ProductName->Visible) { // ProductName ?>
		<!-- ProductName -->
		<td<?php echo $vt_orderguide->ProductName->cellAttributes() ?>>
<span<?php echo $vt_orderguide->ProductName->viewAttributes() ?>>
<?php echo $vt_orderguide->ProductName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vt_orderguide->PCS->Visible) { // PCS ?>
		<!-- PCS -->
		<td<?php echo $vt_orderguide->PCS->cellAttributes() ?>>
<span<?php echo $vt_orderguide->PCS->viewAttributes() ?>>
<?php echo $vt_orderguide->PCS->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vt_orderguide->Location->Visible) { // Location ?>
		<!-- Location -->
		<td<?php echo $vt_orderguide->Location->cellAttributes() ?>>
<span<?php echo $vt_orderguide->Location->viewAttributes() ?>>
<?php echo $vt_orderguide->Location->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$vt_orderguide_preview->ListOptions->render("body", "right", $vt_orderguide_preview->RowCnt);
?>
	</tr>
<?php
	$vt_orderguide_preview->Recordset->MoveNext();
}
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<?php } ?>
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php if ($vt_orderguide_preview->TotalRecs > 0) { ?>
<?php if (!isset($vt_orderguide_preview->Pager)) $vt_orderguide_preview->Pager = new PrevNextPager($vt_orderguide_preview->StartRec, $vt_orderguide_preview->DisplayRecs, $vt_orderguide_preview->TotalRecs) ?>
<?php if ($vt_orderguide_preview->Pager->RecordCount > 0 && $vt_orderguide_preview->Pager->Visible) { ?>
<div class="ew-pager"><div class="ew-prev-next"><div class="btn-group btn-group-sm ew-btn-group">
<!--first page button-->
	<?php if ($vt_orderguide_preview->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" data-start="<?php echo $vt_orderguide_preview->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($vt_orderguide_preview->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" data-start="<?php echo $vt_orderguide_preview->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
<!--next page button-->
	<?php if ($vt_orderguide_preview->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" data-start="<?php echo $vt_orderguide_preview->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!--last page button-->
	<?php if ($vt_orderguide_preview->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" data-start="<?php echo $vt_orderguide_preview->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div></div></div>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vt_orderguide_preview->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vt_orderguide_preview->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vt_orderguide_preview->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php } else { ?>
<div class="ew-detail-count"><?php echo $Language->Phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($vt_orderguide_preview->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
</div><!-- /.card -->
<?php
$vt_orderguide_preview->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php
if ($vt_orderguide_preview->Recordset)
	$vt_orderguide_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$vt_orderguide_preview->terminate();
?>