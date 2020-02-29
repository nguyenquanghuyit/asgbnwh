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
$tbl_packingdetail_preview = new tbl_packingdetail_preview();

// Run the page
$tbl_packingdetail_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_packingdetail_preview->Page_Render();
?>
<?php $tbl_packingdetail_preview->showPageHeader(); ?>
<div class="card ew-grid tbl_packingdetail"><!-- .card -->
<?php if ($tbl_packingdetail_preview->TotalRecs > 0) { ?>
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$tbl_packingdetail_preview->renderListOptions();

// Render list options (header, left)
$tbl_packingdetail_preview->ListOptions->render("header", "left");
?>
<?php if ($tbl_packingdetail->ID_packingDetail->Visible) { // ID_packingDetail ?>
	<?php if ($tbl_packingdetail->SortUrl($tbl_packingdetail->ID_packingDetail) == "") { ?>
		<th class="<?php echo $tbl_packingdetail->ID_packingDetail->headerCellClass() ?>"><?php echo $tbl_packingdetail->ID_packingDetail->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_packingdetail->ID_packingDetail->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_packingdetail->ID_packingDetail->Name ?>" data-sort-order="<?php echo $tbl_packingdetail_preview->SortField == $tbl_packingdetail->ID_packingDetail->Name && $tbl_packingdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_packingdetail->ID_packingDetail->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_packingdetail_preview->SortField == $tbl_packingdetail->ID_packingDetail->Name) { ?><?php if ($tbl_packingdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_packingdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->PackingOrNoPacking->Visible) { // PackingOrNoPacking ?>
	<?php if ($tbl_packingdetail->SortUrl($tbl_packingdetail->PackingOrNoPacking) == "") { ?>
		<th class="<?php echo $tbl_packingdetail->PackingOrNoPacking->headerCellClass() ?>"><?php echo $tbl_packingdetail->PackingOrNoPacking->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_packingdetail->PackingOrNoPacking->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_packingdetail->PackingOrNoPacking->Name ?>" data-sort-order="<?php echo $tbl_packingdetail_preview->SortField == $tbl_packingdetail->PackingOrNoPacking->Name && $tbl_packingdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_packingdetail->PackingOrNoPacking->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_packingdetail_preview->SortField == $tbl_packingdetail->PackingOrNoPacking->Name) { ?><?php if ($tbl_packingdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_packingdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->PackingType->Visible) { // PackingType ?>
	<?php if ($tbl_packingdetail->SortUrl($tbl_packingdetail->PackingType) == "") { ?>
		<th class="<?php echo $tbl_packingdetail->PackingType->headerCellClass() ?>"><?php echo $tbl_packingdetail->PackingType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_packingdetail->PackingType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_packingdetail->PackingType->Name ?>" data-sort-order="<?php echo $tbl_packingdetail_preview->SortField == $tbl_packingdetail->PackingType->Name && $tbl_packingdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_packingdetail->PackingType->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_packingdetail_preview->SortField == $tbl_packingdetail->PackingType->Name) { ?><?php if ($tbl_packingdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_packingdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->Length->Visible) { // Length ?>
	<?php if ($tbl_packingdetail->SortUrl($tbl_packingdetail->Length) == "") { ?>
		<th class="<?php echo $tbl_packingdetail->Length->headerCellClass() ?>"><?php echo $tbl_packingdetail->Length->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_packingdetail->Length->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_packingdetail->Length->Name ?>" data-sort-order="<?php echo $tbl_packingdetail_preview->SortField == $tbl_packingdetail->Length->Name && $tbl_packingdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_packingdetail->Length->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_packingdetail_preview->SortField == $tbl_packingdetail->Length->Name) { ?><?php if ($tbl_packingdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_packingdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->Width->Visible) { // Width ?>
	<?php if ($tbl_packingdetail->SortUrl($tbl_packingdetail->Width) == "") { ?>
		<th class="<?php echo $tbl_packingdetail->Width->headerCellClass() ?>"><?php echo $tbl_packingdetail->Width->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_packingdetail->Width->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_packingdetail->Width->Name ?>" data-sort-order="<?php echo $tbl_packingdetail_preview->SortField == $tbl_packingdetail->Width->Name && $tbl_packingdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_packingdetail->Width->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_packingdetail_preview->SortField == $tbl_packingdetail->Width->Name) { ?><?php if ($tbl_packingdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_packingdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->Heigth->Visible) { // Heigth ?>
	<?php if ($tbl_packingdetail->SortUrl($tbl_packingdetail->Heigth) == "") { ?>
		<th class="<?php echo $tbl_packingdetail->Heigth->headerCellClass() ?>"><?php echo $tbl_packingdetail->Heigth->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_packingdetail->Heigth->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_packingdetail->Heigth->Name ?>" data-sort-order="<?php echo $tbl_packingdetail_preview->SortField == $tbl_packingdetail->Heigth->Name && $tbl_packingdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_packingdetail->Heigth->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_packingdetail_preview->SortField == $tbl_packingdetail->Heigth->Name) { ?><?php if ($tbl_packingdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_packingdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->PE_film_Cover->Visible) { // PE_film_Cover ?>
	<?php if ($tbl_packingdetail->SortUrl($tbl_packingdetail->PE_film_Cover) == "") { ?>
		<th class="<?php echo $tbl_packingdetail->PE_film_Cover->headerCellClass() ?>"><?php echo $tbl_packingdetail->PE_film_Cover->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_packingdetail->PE_film_Cover->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_packingdetail->PE_film_Cover->Name ?>" data-sort-order="<?php echo $tbl_packingdetail_preview->SortField == $tbl_packingdetail->PE_film_Cover->Name && $tbl_packingdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_packingdetail->PE_film_Cover->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_packingdetail_preview->SortField == $tbl_packingdetail->PE_film_Cover->Name) { ?><?php if ($tbl_packingdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_packingdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->finishpacking->Visible) { // finishpacking ?>
	<?php if ($tbl_packingdetail->SortUrl($tbl_packingdetail->finishpacking) == "") { ?>
		<th class="<?php echo $tbl_packingdetail->finishpacking->headerCellClass() ?>"><?php echo $tbl_packingdetail->finishpacking->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_packingdetail->finishpacking->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_packingdetail->finishpacking->Name ?>" data-sort-order="<?php echo $tbl_packingdetail_preview->SortField == $tbl_packingdetail->finishpacking->Name && $tbl_packingdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_packingdetail->finishpacking->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_packingdetail_preview->SortField == $tbl_packingdetail->finishpacking->Name) { ?><?php if ($tbl_packingdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_packingdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_packingdetail_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$tbl_packingdetail_preview->RecCount = 0;
$tbl_packingdetail_preview->RowCnt = 0;
while ($tbl_packingdetail_preview->Recordset && !$tbl_packingdetail_preview->Recordset->EOF) {

	// Init row class and style
	$tbl_packingdetail_preview->RecCount++;
	$tbl_packingdetail_preview->RowCnt++;
	$tbl_packingdetail_preview->CssStyle = "";
	$tbl_packingdetail_preview->loadListRowValues($tbl_packingdetail_preview->Recordset);

	// Render row
	$tbl_packingdetail_preview->RowType = ROWTYPE_PREVIEW; // Preview record
	$tbl_packingdetail_preview->resetAttributes();
	$tbl_packingdetail_preview->renderListRow();

	// Render list options
	$tbl_packingdetail_preview->renderListOptions();
?>
	<tr<?php echo $tbl_packingdetail_preview->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_packingdetail_preview->ListOptions->render("body", "left", $tbl_packingdetail_preview->RowCnt);
?>
<?php if ($tbl_packingdetail->ID_packingDetail->Visible) { // ID_packingDetail ?>
		<!-- ID_packingDetail -->
		<td<?php echo $tbl_packingdetail->ID_packingDetail->cellAttributes() ?>>
<span<?php echo $tbl_packingdetail->ID_packingDetail->viewAttributes() ?>>
<?php echo $tbl_packingdetail->ID_packingDetail->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_packingdetail->PackingOrNoPacking->Visible) { // PackingOrNoPacking ?>
		<!-- PackingOrNoPacking -->
		<td<?php echo $tbl_packingdetail->PackingOrNoPacking->cellAttributes() ?>>
<span<?php echo $tbl_packingdetail->PackingOrNoPacking->viewAttributes() ?>>
<?php echo $tbl_packingdetail->PackingOrNoPacking->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_packingdetail->PackingType->Visible) { // PackingType ?>
		<!-- PackingType -->
		<td<?php echo $tbl_packingdetail->PackingType->cellAttributes() ?>>
<span<?php echo $tbl_packingdetail->PackingType->viewAttributes() ?>>
<?php echo $tbl_packingdetail->PackingType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_packingdetail->Length->Visible) { // Length ?>
		<!-- Length -->
		<td<?php echo $tbl_packingdetail->Length->cellAttributes() ?>>
<span<?php echo $tbl_packingdetail->Length->viewAttributes() ?>>
<?php echo $tbl_packingdetail->Length->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_packingdetail->Width->Visible) { // Width ?>
		<!-- Width -->
		<td<?php echo $tbl_packingdetail->Width->cellAttributes() ?>>
<span<?php echo $tbl_packingdetail->Width->viewAttributes() ?>>
<?php echo $tbl_packingdetail->Width->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_packingdetail->Heigth->Visible) { // Heigth ?>
		<!-- Heigth -->
		<td<?php echo $tbl_packingdetail->Heigth->cellAttributes() ?>>
<span<?php echo $tbl_packingdetail->Heigth->viewAttributes() ?>>
<?php echo $tbl_packingdetail->Heigth->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_packingdetail->PE_film_Cover->Visible) { // PE_film_Cover ?>
		<!-- PE_film_Cover -->
		<td<?php echo $tbl_packingdetail->PE_film_Cover->cellAttributes() ?>>
<span<?php echo $tbl_packingdetail->PE_film_Cover->viewAttributes() ?>>
<?php echo $tbl_packingdetail->PE_film_Cover->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_packingdetail->finishpacking->Visible) { // finishpacking ?>
		<!-- finishpacking -->
		<td<?php echo $tbl_packingdetail->finishpacking->cellAttributes() ?>>
<span<?php echo $tbl_packingdetail->finishpacking->viewAttributes() ?>>
<?php echo $tbl_packingdetail->finishpacking->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$tbl_packingdetail_preview->ListOptions->render("body", "right", $tbl_packingdetail_preview->RowCnt);
?>
	</tr>
<?php
	$tbl_packingdetail_preview->Recordset->MoveNext();
}
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<?php } ?>
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php if ($tbl_packingdetail_preview->TotalRecs > 0) { ?>
<?php if (!isset($tbl_packingdetail_preview->Pager)) $tbl_packingdetail_preview->Pager = new PrevNextPager($tbl_packingdetail_preview->StartRec, $tbl_packingdetail_preview->DisplayRecs, $tbl_packingdetail_preview->TotalRecs) ?>
<?php if ($tbl_packingdetail_preview->Pager->RecordCount > 0 && $tbl_packingdetail_preview->Pager->Visible) { ?>
<div class="ew-pager"><div class="ew-prev-next"><div class="btn-group btn-group-sm ew-btn-group">
<!--first page button-->
	<?php if ($tbl_packingdetail_preview->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" data-start="<?php echo $tbl_packingdetail_preview->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_packingdetail_preview->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" data-start="<?php echo $tbl_packingdetail_preview->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
<!--next page button-->
	<?php if ($tbl_packingdetail_preview->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" data-start="<?php echo $tbl_packingdetail_preview->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_packingdetail_preview->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" data-start="<?php echo $tbl_packingdetail_preview->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div></div></div>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_packingdetail_preview->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_packingdetail_preview->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_packingdetail_preview->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php } else { ?>
<div class="ew-detail-count"><?php echo $Language->Phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($tbl_packingdetail_preview->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
</div><!-- /.card -->
<?php
$tbl_packingdetail_preview->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php
if ($tbl_packingdetail_preview->Recordset)
	$tbl_packingdetail_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$tbl_packingdetail_preview->terminate();
?>