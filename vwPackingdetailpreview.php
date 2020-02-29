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
$vwPackingdetail_preview = new vwPackingdetail_preview();

// Run the page
$vwPackingdetail_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwPackingdetail_preview->Page_Render();
?>
<?php $vwPackingdetail_preview->showPageHeader(); ?>
<div class="card ew-grid vwPackingdetail"><!-- .card -->
<?php if ($vwPackingdetail_preview->TotalRecs > 0) { ?>
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$vwPackingdetail_preview->renderListOptions();

// Render list options (header, left)
$vwPackingdetail_preview->ListOptions->render("header", "left");
?>
<?php if ($vwPackingdetail->Id_packing->Visible) { // Id_packing ?>
	<?php if ($vwPackingdetail->SortUrl($vwPackingdetail->Id_packing) == "") { ?>
		<th class="<?php echo $vwPackingdetail->Id_packing->headerCellClass() ?>"><?php echo $vwPackingdetail->Id_packing->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwPackingdetail->Id_packing->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwPackingdetail->Id_packing->Name ?>" data-sort-order="<?php echo $vwPackingdetail_preview->SortField == $vwPackingdetail->Id_packing->Name && $vwPackingdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwPackingdetail->Id_packing->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwPackingdetail_preview->SortField == $vwPackingdetail->Id_packing->Name) { ?><?php if ($vwPackingdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwPackingdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->Code->Visible) { // Code ?>
	<?php if ($vwPackingdetail->SortUrl($vwPackingdetail->Code) == "") { ?>
		<th class="<?php echo $vwPackingdetail->Code->headerCellClass() ?>"><?php echo $vwPackingdetail->Code->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwPackingdetail->Code->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwPackingdetail->Code->Name ?>" data-sort-order="<?php echo $vwPackingdetail_preview->SortField == $vwPackingdetail->Code->Name && $vwPackingdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwPackingdetail->Code->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwPackingdetail_preview->SortField == $vwPackingdetail->Code->Name) { ?><?php if ($vwPackingdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwPackingdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->PCS->Visible) { // PCS ?>
	<?php if ($vwPackingdetail->SortUrl($vwPackingdetail->PCS) == "") { ?>
		<th class="<?php echo $vwPackingdetail->PCS->headerCellClass() ?>"><?php echo $vwPackingdetail->PCS->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwPackingdetail->PCS->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwPackingdetail->PCS->Name ?>" data-sort-order="<?php echo $vwPackingdetail_preview->SortField == $vwPackingdetail->PCS->Name && $vwPackingdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwPackingdetail->PCS->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwPackingdetail_preview->SortField == $vwPackingdetail->PCS->Name) { ?><?php if ($vwPackingdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwPackingdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->PackingType->Visible) { // PackingType ?>
	<?php if ($vwPackingdetail->SortUrl($vwPackingdetail->PackingType) == "") { ?>
		<th class="<?php echo $vwPackingdetail->PackingType->headerCellClass() ?>"><?php echo $vwPackingdetail->PackingType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwPackingdetail->PackingType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwPackingdetail->PackingType->Name ?>" data-sort-order="<?php echo $vwPackingdetail_preview->SortField == $vwPackingdetail->PackingType->Name && $vwPackingdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwPackingdetail->PackingType->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwPackingdetail_preview->SortField == $vwPackingdetail->PackingType->Name) { ?><?php if ($vwPackingdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwPackingdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->Length->Visible) { // Length ?>
	<?php if ($vwPackingdetail->SortUrl($vwPackingdetail->Length) == "") { ?>
		<th class="<?php echo $vwPackingdetail->Length->headerCellClass() ?>"><?php echo $vwPackingdetail->Length->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwPackingdetail->Length->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwPackingdetail->Length->Name ?>" data-sort-order="<?php echo $vwPackingdetail_preview->SortField == $vwPackingdetail->Length->Name && $vwPackingdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwPackingdetail->Length->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwPackingdetail_preview->SortField == $vwPackingdetail->Length->Name) { ?><?php if ($vwPackingdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwPackingdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->Width->Visible) { // Width ?>
	<?php if ($vwPackingdetail->SortUrl($vwPackingdetail->Width) == "") { ?>
		<th class="<?php echo $vwPackingdetail->Width->headerCellClass() ?>"><?php echo $vwPackingdetail->Width->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwPackingdetail->Width->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwPackingdetail->Width->Name ?>" data-sort-order="<?php echo $vwPackingdetail_preview->SortField == $vwPackingdetail->Width->Name && $vwPackingdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwPackingdetail->Width->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwPackingdetail_preview->SortField == $vwPackingdetail->Width->Name) { ?><?php if ($vwPackingdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwPackingdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->Heigth->Visible) { // Heigth ?>
	<?php if ($vwPackingdetail->SortUrl($vwPackingdetail->Heigth) == "") { ?>
		<th class="<?php echo $vwPackingdetail->Heigth->headerCellClass() ?>"><?php echo $vwPackingdetail->Heigth->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwPackingdetail->Heigth->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwPackingdetail->Heigth->Name ?>" data-sort-order="<?php echo $vwPackingdetail_preview->SortField == $vwPackingdetail->Heigth->Name && $vwPackingdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwPackingdetail->Heigth->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwPackingdetail_preview->SortField == $vwPackingdetail->Heigth->Name) { ?><?php if ($vwPackingdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwPackingdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->finishpacking->Visible) { // finishpacking ?>
	<?php if ($vwPackingdetail->SortUrl($vwPackingdetail->finishpacking) == "") { ?>
		<th class="<?php echo $vwPackingdetail->finishpacking->headerCellClass() ?>"><?php echo $vwPackingdetail->finishpacking->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwPackingdetail->finishpacking->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwPackingdetail->finishpacking->Name ?>" data-sort-order="<?php echo $vwPackingdetail_preview->SortField == $vwPackingdetail->finishpacking->Name && $vwPackingdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwPackingdetail->finishpacking->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwPackingdetail_preview->SortField == $vwPackingdetail->finishpacking->Name) { ?><?php if ($vwPackingdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwPackingdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->PE_film_Cover->Visible) { // PE_film_Cover ?>
	<?php if ($vwPackingdetail->SortUrl($vwPackingdetail->PE_film_Cover) == "") { ?>
		<th class="<?php echo $vwPackingdetail->PE_film_Cover->headerCellClass() ?>"><?php echo $vwPackingdetail->PE_film_Cover->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwPackingdetail->PE_film_Cover->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwPackingdetail->PE_film_Cover->Name ?>" data-sort-order="<?php echo $vwPackingdetail_preview->SortField == $vwPackingdetail->PE_film_Cover->Name && $vwPackingdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwPackingdetail->PE_film_Cover->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwPackingdetail_preview->SortField == $vwPackingdetail->PE_film_Cover->Name) { ?><?php if ($vwPackingdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwPackingdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->CreateUser->Visible) { // CreateUser ?>
	<?php if ($vwPackingdetail->SortUrl($vwPackingdetail->CreateUser) == "") { ?>
		<th class="<?php echo $vwPackingdetail->CreateUser->headerCellClass() ?>"><?php echo $vwPackingdetail->CreateUser->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwPackingdetail->CreateUser->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwPackingdetail->CreateUser->Name ?>" data-sort-order="<?php echo $vwPackingdetail_preview->SortField == $vwPackingdetail->CreateUser->Name && $vwPackingdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwPackingdetail->CreateUser->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwPackingdetail_preview->SortField == $vwPackingdetail->CreateUser->Name) { ?><?php if ($vwPackingdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwPackingdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->CreateDate->Visible) { // CreateDate ?>
	<?php if ($vwPackingdetail->SortUrl($vwPackingdetail->CreateDate) == "") { ?>
		<th class="<?php echo $vwPackingdetail->CreateDate->headerCellClass() ?>"><?php echo $vwPackingdetail->CreateDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwPackingdetail->CreateDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwPackingdetail->CreateDate->Name ?>" data-sort-order="<?php echo $vwPackingdetail_preview->SortField == $vwPackingdetail->CreateDate->Name && $vwPackingdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwPackingdetail->CreateDate->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwPackingdetail_preview->SortField == $vwPackingdetail->CreateDate->Name) { ?><?php if ($vwPackingdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwPackingdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->Box->Visible) { // Box ?>
	<?php if ($vwPackingdetail->SortUrl($vwPackingdetail->Box) == "") { ?>
		<th class="<?php echo $vwPackingdetail->Box->headerCellClass() ?>"><?php echo $vwPackingdetail->Box->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwPackingdetail->Box->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwPackingdetail->Box->Name ?>" data-sort-order="<?php echo $vwPackingdetail_preview->SortField == $vwPackingdetail->Box->Name && $vwPackingdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwPackingdetail->Box->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwPackingdetail_preview->SortField == $vwPackingdetail->Box->Name) { ?><?php if ($vwPackingdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwPackingdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwPackingdetail_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$vwPackingdetail_preview->RecCount = 0;
$vwPackingdetail_preview->RowCnt = 0;
while ($vwPackingdetail_preview->Recordset && !$vwPackingdetail_preview->Recordset->EOF) {

	// Init row class and style
	$vwPackingdetail_preview->RecCount++;
	$vwPackingdetail_preview->RowCnt++;
	$vwPackingdetail_preview->CssStyle = "";
	$vwPackingdetail_preview->loadListRowValues($vwPackingdetail_preview->Recordset);

	// Render row
	$vwPackingdetail_preview->RowType = ROWTYPE_PREVIEW; // Preview record
	$vwPackingdetail_preview->resetAttributes();
	$vwPackingdetail_preview->renderListRow();

	// Render list options
	$vwPackingdetail_preview->renderListOptions();
?>
	<tr<?php echo $vwPackingdetail_preview->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwPackingdetail_preview->ListOptions->render("body", "left", $vwPackingdetail_preview->RowCnt);
?>
<?php if ($vwPackingdetail->Id_packing->Visible) { // Id_packing ?>
		<!-- Id_packing -->
		<td<?php echo $vwPackingdetail->Id_packing->cellAttributes() ?>>
<span<?php echo $vwPackingdetail->Id_packing->viewAttributes() ?>>
<?php echo $vwPackingdetail->Id_packing->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwPackingdetail->Code->Visible) { // Code ?>
		<!-- Code -->
		<td<?php echo $vwPackingdetail->Code->cellAttributes() ?>>
<span<?php echo $vwPackingdetail->Code->viewAttributes() ?>>
<?php echo $vwPackingdetail->Code->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwPackingdetail->PCS->Visible) { // PCS ?>
		<!-- PCS -->
		<td<?php echo $vwPackingdetail->PCS->cellAttributes() ?>>
<span<?php echo $vwPackingdetail->PCS->viewAttributes() ?>>
<?php echo $vwPackingdetail->PCS->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwPackingdetail->PackingType->Visible) { // PackingType ?>
		<!-- PackingType -->
		<td<?php echo $vwPackingdetail->PackingType->cellAttributes() ?>>
<span<?php echo $vwPackingdetail->PackingType->viewAttributes() ?>>
<?php echo $vwPackingdetail->PackingType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwPackingdetail->Length->Visible) { // Length ?>
		<!-- Length -->
		<td<?php echo $vwPackingdetail->Length->cellAttributes() ?>>
<span<?php echo $vwPackingdetail->Length->viewAttributes() ?>>
<?php echo $vwPackingdetail->Length->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwPackingdetail->Width->Visible) { // Width ?>
		<!-- Width -->
		<td<?php echo $vwPackingdetail->Width->cellAttributes() ?>>
<span<?php echo $vwPackingdetail->Width->viewAttributes() ?>>
<?php echo $vwPackingdetail->Width->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwPackingdetail->Heigth->Visible) { // Heigth ?>
		<!-- Heigth -->
		<td<?php echo $vwPackingdetail->Heigth->cellAttributes() ?>>
<span<?php echo $vwPackingdetail->Heigth->viewAttributes() ?>>
<?php echo $vwPackingdetail->Heigth->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwPackingdetail->finishpacking->Visible) { // finishpacking ?>
		<!-- finishpacking -->
		<td<?php echo $vwPackingdetail->finishpacking->cellAttributes() ?>>
<span<?php echo $vwPackingdetail->finishpacking->viewAttributes() ?>>
<?php echo $vwPackingdetail->finishpacking->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwPackingdetail->PE_film_Cover->Visible) { // PE_film_Cover ?>
		<!-- PE_film_Cover -->
		<td<?php echo $vwPackingdetail->PE_film_Cover->cellAttributes() ?>>
<span<?php echo $vwPackingdetail->PE_film_Cover->viewAttributes() ?>>
<?php echo $vwPackingdetail->PE_film_Cover->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwPackingdetail->CreateUser->Visible) { // CreateUser ?>
		<!-- CreateUser -->
		<td<?php echo $vwPackingdetail->CreateUser->cellAttributes() ?>>
<span<?php echo $vwPackingdetail->CreateUser->viewAttributes() ?>>
<?php echo $vwPackingdetail->CreateUser->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwPackingdetail->CreateDate->Visible) { // CreateDate ?>
		<!-- CreateDate -->
		<td<?php echo $vwPackingdetail->CreateDate->cellAttributes() ?>>
<span<?php echo $vwPackingdetail->CreateDate->viewAttributes() ?>>
<?php echo $vwPackingdetail->CreateDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwPackingdetail->Box->Visible) { // Box ?>
		<!-- Box -->
		<td<?php echo $vwPackingdetail->Box->cellAttributes() ?>>
<span<?php echo $vwPackingdetail->Box->viewAttributes() ?>>
<?php echo $vwPackingdetail->Box->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$vwPackingdetail_preview->ListOptions->render("body", "right", $vwPackingdetail_preview->RowCnt);
?>
	</tr>
<?php
	$vwPackingdetail_preview->Recordset->MoveNext();
}
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<?php } ?>
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php if ($vwPackingdetail_preview->TotalRecs > 0) { ?>
<?php if (!isset($vwPackingdetail_preview->Pager)) $vwPackingdetail_preview->Pager = new PrevNextPager($vwPackingdetail_preview->StartRec, $vwPackingdetail_preview->DisplayRecs, $vwPackingdetail_preview->TotalRecs) ?>
<?php if ($vwPackingdetail_preview->Pager->RecordCount > 0 && $vwPackingdetail_preview->Pager->Visible) { ?>
<div class="ew-pager"><div class="ew-prev-next"><div class="btn-group btn-group-sm ew-btn-group">
<!--first page button-->
	<?php if ($vwPackingdetail_preview->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" data-start="<?php echo $vwPackingdetail_preview->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($vwPackingdetail_preview->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" data-start="<?php echo $vwPackingdetail_preview->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
<!--next page button-->
	<?php if ($vwPackingdetail_preview->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" data-start="<?php echo $vwPackingdetail_preview->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!--last page button-->
	<?php if ($vwPackingdetail_preview->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" data-start="<?php echo $vwPackingdetail_preview->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div></div></div>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwPackingdetail_preview->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwPackingdetail_preview->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwPackingdetail_preview->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php } else { ?>
<div class="ew-detail-count"><?php echo $Language->Phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($vwPackingdetail_preview->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
</div><!-- /.card -->
<?php
$vwPackingdetail_preview->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php
if ($vwPackingdetail_preview->Recordset)
	$vwPackingdetail_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$vwPackingdetail_preview->terminate();
?>