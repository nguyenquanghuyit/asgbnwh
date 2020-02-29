<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Table class for vworder_packing
 */
class vworder_packing extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $ID_Order;
	public $OrderDate;
	public $ID_Contact;
	public $StatusLoad;
	public $CreateUser;
	public $CreateDate;
	public $UpdateUser;
	public $UpdateDate;
	public $StatusFinishOrder;
	public $DateTimefinishOrder;
	public $UserFinishOrder;
	public $CusomterOrderNo;
	public $InvoiceNo;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'vworder_packing';
		$this->TableName = 'vworder_packing';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`vworder_packing`";
		$this->Dbid = 'DB';
		$this->ExportAll = FALSE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 8;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// ID_Order
		$this->ID_Order = new DbField('vworder_packing', 'vworder_packing', 'x_ID_Order', 'ID_Order', '`ID_Order`', '`ID_Order`', 3, -1, FALSE, '`ID_Order`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ID_Order->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ID_Order->IsPrimaryKey = TRUE; // Primary key field
		$this->ID_Order->Sortable = TRUE; // Allow sort
		$this->ID_Order->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Order'] = &$this->ID_Order;

		// OrderDate
		$this->OrderDate = new DbField('vworder_packing', 'vworder_packing', 'x_OrderDate', 'OrderDate', '`OrderDate`', CastDateFieldForLike('`OrderDate`', 0, "DB"), 135, 0, FALSE, '`OrderDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OrderDate->Sortable = TRUE; // Allow sort
		$this->OrderDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['OrderDate'] = &$this->OrderDate;

		// ID_Contact
		$this->ID_Contact = new DbField('vworder_packing', 'vworder_packing', 'x_ID_Contact', 'ID_Contact', '`ID_Contact`', '`ID_Contact`', 3, -1, FALSE, '`ID_Contact`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_Contact->Sortable = TRUE; // Allow sort
		$this->ID_Contact->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Contact'] = &$this->ID_Contact;

		// StatusLoad
		$this->StatusLoad = new DbField('vworder_packing', 'vworder_packing', 'x_StatusLoad', 'StatusLoad', '`StatusLoad`', '`StatusLoad`', 16, -1, FALSE, '`StatusLoad`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->StatusLoad->Sortable = TRUE; // Allow sort
		$this->StatusLoad->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['StatusLoad'] = &$this->StatusLoad;

		// CreateUser
		$this->CreateUser = new DbField('vworder_packing', 'vworder_packing', 'x_CreateUser', 'CreateUser', '`CreateUser`', '`CreateUser`', 200, -1, FALSE, '`CreateUser`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CreateUser->Sortable = FALSE; // Allow sort
		$this->fields['CreateUser'] = &$this->CreateUser;

		// CreateDate
		$this->CreateDate = new DbField('vworder_packing', 'vworder_packing', 'x_CreateDate', 'CreateDate', '`CreateDate`', CastDateFieldForLike('`CreateDate`', 0, "DB"), 135, 0, FALSE, '`CreateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CreateDate->Sortable = FALSE; // Allow sort
		$this->CreateDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['CreateDate'] = &$this->CreateDate;

		// UpdateUser
		$this->UpdateUser = new DbField('vworder_packing', 'vworder_packing', 'x_UpdateUser', 'UpdateUser', '`UpdateUser`', '`UpdateUser`', 200, -1, FALSE, '`UpdateUser`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UpdateUser->Sortable = FALSE; // Allow sort
		$this->fields['UpdateUser'] = &$this->UpdateUser;

		// UpdateDate
		$this->UpdateDate = new DbField('vworder_packing', 'vworder_packing', 'x_UpdateDate', 'UpdateDate', '`UpdateDate`', CastDateFieldForLike('`UpdateDate`', 0, "DB"), 135, 0, FALSE, '`UpdateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UpdateDate->Sortable = FALSE; // Allow sort
		$this->UpdateDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['UpdateDate'] = &$this->UpdateDate;

		// StatusFinishOrder
		$this->StatusFinishOrder = new DbField('vworder_packing', 'vworder_packing', 'x_StatusFinishOrder', 'StatusFinishOrder', '`StatusFinishOrder`', '`StatusFinishOrder`', 16, -1, FALSE, '`StatusFinishOrder`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->StatusFinishOrder->Sortable = TRUE; // Allow sort
		$this->StatusFinishOrder->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['StatusFinishOrder'] = &$this->StatusFinishOrder;

		// DateTimefinishOrder
		$this->DateTimefinishOrder = new DbField('vworder_packing', 'vworder_packing', 'x_DateTimefinishOrder', 'DateTimefinishOrder', '`DateTimefinishOrder`', CastDateFieldForLike('`DateTimefinishOrder`', 0, "DB"), 135, 0, FALSE, '`DateTimefinishOrder`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateTimefinishOrder->Sortable = TRUE; // Allow sort
		$this->DateTimefinishOrder->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateTimefinishOrder'] = &$this->DateTimefinishOrder;

		// UserFinishOrder
		$this->UserFinishOrder = new DbField('vworder_packing', 'vworder_packing', 'x_UserFinishOrder', 'UserFinishOrder', '`UserFinishOrder`', '`UserFinishOrder`', 200, -1, FALSE, '`UserFinishOrder`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UserFinishOrder->Sortable = FALSE; // Allow sort
		$this->fields['UserFinishOrder'] = &$this->UserFinishOrder;

		// CusomterOrderNo
		$this->CusomterOrderNo = new DbField('vworder_packing', 'vworder_packing', 'x_CusomterOrderNo', 'CusomterOrderNo', '`CusomterOrderNo`', '`CusomterOrderNo`', 200, -1, FALSE, '`CusomterOrderNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CusomterOrderNo->Sortable = TRUE; // Allow sort
		$this->fields['CusomterOrderNo'] = &$this->CusomterOrderNo;

		// InvoiceNo
		$this->InvoiceNo = new DbField('vworder_packing', 'vworder_packing', 'x_InvoiceNo', 'InvoiceNo', '`InvoiceNo`', '`InvoiceNo`', 200, -1, FALSE, '`InvoiceNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->InvoiceNo->Sortable = TRUE; // Allow sort
		$this->fields['InvoiceNo'] = &$this->InvoiceNo;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Multiple column sort
	public function updateSort(&$fld, $ctrl)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			if ($ctrl) {
				$orderBy = $this->getSessionOrderBy();
				if (ContainsString($orderBy, $sortField . " " . $lastSort)) {
					$orderBy = str_replace($sortField . " " . $lastSort, $sortField . " " . $thisSort, $orderBy);
				} else {
					if ($orderBy <> "")
						$orderBy .= ", ";
					$orderBy .= $sortField . " " . $thisSort;
				}
				$this->setSessionOrderBy($orderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
			}
		} else {
			if (!$ctrl)
				$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`vworder_packing`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect <> "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere <> "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy <> "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving <> "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->ID_Order->setDbValue($conn->insert_ID());
			$rs['ID_Order'] = $this->ID_Order->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsPrimaryKey)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('ID_Order', $rs))
				AddFilter($where, QuotedName('ID_Order', $this->Dbid) . '=' . QuotedValue($rs['ID_Order'], $this->ID_Order->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = &$this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->ID_Order->DbValue = $row['ID_Order'];
		$this->OrderDate->DbValue = $row['OrderDate'];
		$this->ID_Contact->DbValue = $row['ID_Contact'];
		$this->StatusLoad->DbValue = $row['StatusLoad'];
		$this->CreateUser->DbValue = $row['CreateUser'];
		$this->CreateDate->DbValue = $row['CreateDate'];
		$this->UpdateUser->DbValue = $row['UpdateUser'];
		$this->UpdateDate->DbValue = $row['UpdateDate'];
		$this->StatusFinishOrder->DbValue = $row['StatusFinishOrder'];
		$this->DateTimefinishOrder->DbValue = $row['DateTimefinishOrder'];
		$this->UserFinishOrder->DbValue = $row['UserFinishOrder'];
		$this->CusomterOrderNo->DbValue = $row['CusomterOrderNo'];
		$this->InvoiceNo->DbValue = $row['InvoiceNo'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ID_Order` = @ID_Order@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('ID_Order', $row) ? $row['ID_Order'] : NULL) : $this->ID_Order->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ID_Order@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") <> "" && ReferPageName() <> CurrentPageName() && ReferPageName() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "vworder_packinglist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "vworder_packingview.php")
			return $Language->phrase("View");
		elseif ($pageName == "vworder_packingedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "vworder_packingadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "vworder_packinglist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("vworder_packingview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("vworder_packingview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "vworder_packingadd.php?" . $this->getUrlParm($parm);
		else
			$url = "vworder_packingadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("vworder_packingedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("vworder_packingadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("vworder_packingdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ID_Order:" . JsonEncode($this->ID_Order->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm <> "")
			$url .= $parm . "&";
		if ($this->ID_Order->CurrentValue != NULL) {
			$url .= "ID_Order=" . urlencode($this->ID_Order->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("ID_Order") !== NULL)
				$arKeys[] = Param("ID_Order");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys()
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter <> "") $keyFilter .= " OR ";
			$this->ID_Order->CurrentValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = &$this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->ID_Order->setDbValue($rs->fields('ID_Order'));
		$this->OrderDate->setDbValue($rs->fields('OrderDate'));
		$this->ID_Contact->setDbValue($rs->fields('ID_Contact'));
		$this->StatusLoad->setDbValue($rs->fields('StatusLoad'));
		$this->CreateUser->setDbValue($rs->fields('CreateUser'));
		$this->CreateDate->setDbValue($rs->fields('CreateDate'));
		$this->UpdateUser->setDbValue($rs->fields('UpdateUser'));
		$this->UpdateDate->setDbValue($rs->fields('UpdateDate'));
		$this->StatusFinishOrder->setDbValue($rs->fields('StatusFinishOrder'));
		$this->DateTimefinishOrder->setDbValue($rs->fields('DateTimefinishOrder'));
		$this->UserFinishOrder->setDbValue($rs->fields('UserFinishOrder'));
		$this->CusomterOrderNo->setDbValue($rs->fields('CusomterOrderNo'));
		$this->InvoiceNo->setDbValue($rs->fields('InvoiceNo'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ID_Order

		$this->ID_Order->CellCssStyle = "white-space: nowrap;";

		// OrderDate
		$this->OrderDate->CellCssStyle = "white-space: nowrap;";

		// ID_Contact
		$this->ID_Contact->CellCssStyle = "white-space: nowrap;";

		// StatusLoad
		$this->StatusLoad->CellCssStyle = "white-space: nowrap;";

		// CreateUser
		$this->CreateUser->CellCssStyle = "white-space: nowrap;";

		// CreateDate
		$this->CreateDate->CellCssStyle = "white-space: nowrap;";

		// UpdateUser
		$this->UpdateUser->CellCssStyle = "white-space: nowrap;";

		// UpdateDate
		$this->UpdateDate->CellCssStyle = "white-space: nowrap;";

		// StatusFinishOrder
		$this->StatusFinishOrder->CellCssStyle = "white-space: nowrap;";

		// DateTimefinishOrder
		$this->DateTimefinishOrder->CellCssStyle = "white-space: nowrap;";

		// UserFinishOrder
		$this->UserFinishOrder->CellCssStyle = "white-space: nowrap;";

		// CusomterOrderNo
		$this->CusomterOrderNo->CellCssStyle = "white-space: nowrap;";

		// InvoiceNo
		$this->InvoiceNo->CellCssStyle = "white-space: nowrap;";

		// ID_Order
		$this->ID_Order->ViewValue = $this->ID_Order->CurrentValue;
		$this->ID_Order->ViewCustomAttributes = "";

		// OrderDate
		$this->OrderDate->ViewValue = $this->OrderDate->CurrentValue;
		$this->OrderDate->ViewValue = FormatDateTime($this->OrderDate->ViewValue, 0);
		$this->OrderDate->ViewCustomAttributes = "";

		// ID_Contact
		$this->ID_Contact->ViewValue = $this->ID_Contact->CurrentValue;
		$this->ID_Contact->ViewValue = FormatNumber($this->ID_Contact->ViewValue, 0, -2, -2, -2);
		$this->ID_Contact->ViewCustomAttributes = "";

		// StatusLoad
		$this->StatusLoad->ViewValue = $this->StatusLoad->CurrentValue;
		$this->StatusLoad->ViewValue = FormatNumber($this->StatusLoad->ViewValue, 0, -2, -2, -2);
		$this->StatusLoad->ViewCustomAttributes = "";

		// CreateUser
		$this->CreateUser->ViewValue = $this->CreateUser->CurrentValue;
		$this->CreateUser->ViewCustomAttributes = "";

		// CreateDate
		$this->CreateDate->ViewValue = $this->CreateDate->CurrentValue;
		$this->CreateDate->ViewValue = FormatDateTime($this->CreateDate->ViewValue, 0);
		$this->CreateDate->ViewCustomAttributes = "";

		// UpdateUser
		$this->UpdateUser->ViewValue = $this->UpdateUser->CurrentValue;
		$this->UpdateUser->ViewCustomAttributes = "";

		// UpdateDate
		$this->UpdateDate->ViewValue = $this->UpdateDate->CurrentValue;
		$this->UpdateDate->ViewValue = FormatDateTime($this->UpdateDate->ViewValue, 0);
		$this->UpdateDate->ViewCustomAttributes = "";

		// StatusFinishOrder
		$this->StatusFinishOrder->ViewValue = $this->StatusFinishOrder->CurrentValue;
		$this->StatusFinishOrder->ViewValue = FormatNumber($this->StatusFinishOrder->ViewValue, 0, -2, -2, -2);
		$this->StatusFinishOrder->ViewCustomAttributes = "";

		// DateTimefinishOrder
		$this->DateTimefinishOrder->ViewValue = $this->DateTimefinishOrder->CurrentValue;
		$this->DateTimefinishOrder->ViewValue = FormatDateTime($this->DateTimefinishOrder->ViewValue, 0);
		$this->DateTimefinishOrder->ViewCustomAttributes = "";

		// UserFinishOrder
		$this->UserFinishOrder->ViewValue = $this->UserFinishOrder->CurrentValue;
		$this->UserFinishOrder->ViewCustomAttributes = "";

		// CusomterOrderNo
		$this->CusomterOrderNo->ViewValue = $this->CusomterOrderNo->CurrentValue;
		$this->CusomterOrderNo->ViewCustomAttributes = "";

		// InvoiceNo
		$this->InvoiceNo->ViewValue = $this->InvoiceNo->CurrentValue;
		$this->InvoiceNo->ViewCustomAttributes = "";

		// ID_Order
		$this->ID_Order->LinkCustomAttributes = "";
		$this->ID_Order->HrefValue = "";
		$this->ID_Order->TooltipValue = "";

		// OrderDate
		$this->OrderDate->LinkCustomAttributes = "";
		$this->OrderDate->HrefValue = "";
		$this->OrderDate->TooltipValue = "";

		// ID_Contact
		$this->ID_Contact->LinkCustomAttributes = "";
		$this->ID_Contact->HrefValue = "";
		$this->ID_Contact->TooltipValue = "";

		// StatusLoad
		$this->StatusLoad->LinkCustomAttributes = "";
		$this->StatusLoad->HrefValue = "";
		$this->StatusLoad->TooltipValue = "";

		// CreateUser
		$this->CreateUser->LinkCustomAttributes = "";
		$this->CreateUser->HrefValue = "";
		$this->CreateUser->TooltipValue = "";

		// CreateDate
		$this->CreateDate->LinkCustomAttributes = "";
		$this->CreateDate->HrefValue = "";
		$this->CreateDate->TooltipValue = "";

		// UpdateUser
		$this->UpdateUser->LinkCustomAttributes = "";
		$this->UpdateUser->HrefValue = "";
		$this->UpdateUser->TooltipValue = "";

		// UpdateDate
		$this->UpdateDate->LinkCustomAttributes = "";
		$this->UpdateDate->HrefValue = "";
		$this->UpdateDate->TooltipValue = "";

		// StatusFinishOrder
		$this->StatusFinishOrder->LinkCustomAttributes = "";
		$this->StatusFinishOrder->HrefValue = "";
		$this->StatusFinishOrder->TooltipValue = "";

		// DateTimefinishOrder
		$this->DateTimefinishOrder->LinkCustomAttributes = "";
		$this->DateTimefinishOrder->HrefValue = "";
		$this->DateTimefinishOrder->TooltipValue = "";

		// UserFinishOrder
		$this->UserFinishOrder->LinkCustomAttributes = "";
		$this->UserFinishOrder->HrefValue = "";
		$this->UserFinishOrder->TooltipValue = "";

		// CusomterOrderNo
		$this->CusomterOrderNo->LinkCustomAttributes = "";
		$this->CusomterOrderNo->HrefValue = "";
		$this->CusomterOrderNo->TooltipValue = "";

		// InvoiceNo
		$this->InvoiceNo->LinkCustomAttributes = "";
		$this->InvoiceNo->HrefValue = "";
		$this->InvoiceNo->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// ID_Order
		$this->ID_Order->EditAttrs["class"] = "form-control";
		$this->ID_Order->EditCustomAttributes = "";
		$this->ID_Order->EditValue = $this->ID_Order->CurrentValue;
		$this->ID_Order->ViewCustomAttributes = "";

		// OrderDate
		$this->OrderDate->EditAttrs["class"] = "form-control";
		$this->OrderDate->EditCustomAttributes = "";
		$this->OrderDate->EditValue = FormatDateTime($this->OrderDate->CurrentValue, 8);
		$this->OrderDate->PlaceHolder = RemoveHtml($this->OrderDate->caption());

		// ID_Contact
		$this->ID_Contact->EditAttrs["class"] = "form-control";
		$this->ID_Contact->EditCustomAttributes = "";
		$this->ID_Contact->EditValue = $this->ID_Contact->CurrentValue;
		$this->ID_Contact->PlaceHolder = RemoveHtml($this->ID_Contact->caption());

		// StatusLoad
		$this->StatusLoad->EditAttrs["class"] = "form-control";
		$this->StatusLoad->EditCustomAttributes = "";
		$this->StatusLoad->EditValue = $this->StatusLoad->CurrentValue;
		$this->StatusLoad->PlaceHolder = RemoveHtml($this->StatusLoad->caption());

		// CreateUser
		$this->CreateUser->EditAttrs["class"] = "form-control";
		$this->CreateUser->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->CreateUser->CurrentValue = HtmlDecode($this->CreateUser->CurrentValue);
		$this->CreateUser->EditValue = $this->CreateUser->CurrentValue;
		$this->CreateUser->PlaceHolder = RemoveHtml($this->CreateUser->caption());

		// CreateDate
		$this->CreateDate->EditAttrs["class"] = "form-control";
		$this->CreateDate->EditCustomAttributes = "";
		$this->CreateDate->EditValue = FormatDateTime($this->CreateDate->CurrentValue, 8);
		$this->CreateDate->PlaceHolder = RemoveHtml($this->CreateDate->caption());

		// UpdateUser
		$this->UpdateUser->EditAttrs["class"] = "form-control";
		$this->UpdateUser->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->UpdateUser->CurrentValue = HtmlDecode($this->UpdateUser->CurrentValue);
		$this->UpdateUser->EditValue = $this->UpdateUser->CurrentValue;
		$this->UpdateUser->PlaceHolder = RemoveHtml($this->UpdateUser->caption());

		// UpdateDate
		$this->UpdateDate->EditAttrs["class"] = "form-control";
		$this->UpdateDate->EditCustomAttributes = "";
		$this->UpdateDate->EditValue = FormatDateTime($this->UpdateDate->CurrentValue, 8);
		$this->UpdateDate->PlaceHolder = RemoveHtml($this->UpdateDate->caption());

		// StatusFinishOrder
		$this->StatusFinishOrder->EditAttrs["class"] = "form-control";
		$this->StatusFinishOrder->EditCustomAttributes = "";
		$this->StatusFinishOrder->EditValue = $this->StatusFinishOrder->CurrentValue;
		$this->StatusFinishOrder->PlaceHolder = RemoveHtml($this->StatusFinishOrder->caption());

		// DateTimefinishOrder
		$this->DateTimefinishOrder->EditAttrs["class"] = "form-control";
		$this->DateTimefinishOrder->EditCustomAttributes = "";
		$this->DateTimefinishOrder->EditValue = FormatDateTime($this->DateTimefinishOrder->CurrentValue, 8);
		$this->DateTimefinishOrder->PlaceHolder = RemoveHtml($this->DateTimefinishOrder->caption());

		// UserFinishOrder
		$this->UserFinishOrder->EditAttrs["class"] = "form-control";
		$this->UserFinishOrder->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->UserFinishOrder->CurrentValue = HtmlDecode($this->UserFinishOrder->CurrentValue);
		$this->UserFinishOrder->EditValue = $this->UserFinishOrder->CurrentValue;
		$this->UserFinishOrder->PlaceHolder = RemoveHtml($this->UserFinishOrder->caption());

		// CusomterOrderNo
		$this->CusomterOrderNo->EditAttrs["class"] = "form-control";
		$this->CusomterOrderNo->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->CusomterOrderNo->CurrentValue = HtmlDecode($this->CusomterOrderNo->CurrentValue);
		$this->CusomterOrderNo->EditValue = $this->CusomterOrderNo->CurrentValue;
		$this->CusomterOrderNo->PlaceHolder = RemoveHtml($this->CusomterOrderNo->caption());

		// InvoiceNo
		$this->InvoiceNo->EditAttrs["class"] = "form-control";
		$this->InvoiceNo->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->InvoiceNo->CurrentValue = HtmlDecode($this->InvoiceNo->CurrentValue);
		$this->InvoiceNo->EditValue = $this->InvoiceNo->CurrentValue;
		$this->InvoiceNo->PlaceHolder = RemoveHtml($this->InvoiceNo->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->ID_Order);
					$doc->exportCaption($this->OrderDate);
					$doc->exportCaption($this->ID_Contact);
					$doc->exportCaption($this->StatusLoad);
					$doc->exportCaption($this->CreateUser);
					$doc->exportCaption($this->CreateDate);
					$doc->exportCaption($this->UpdateUser);
					$doc->exportCaption($this->UpdateDate);
					$doc->exportCaption($this->StatusFinishOrder);
					$doc->exportCaption($this->DateTimefinishOrder);
					$doc->exportCaption($this->UserFinishOrder);
					$doc->exportCaption($this->CusomterOrderNo);
					$doc->exportCaption($this->InvoiceNo);
				} else {
					$doc->exportCaption($this->ID_Order);
					$doc->exportCaption($this->OrderDate);
					$doc->exportCaption($this->ID_Contact);
					$doc->exportCaption($this->StatusLoad);
					$doc->exportCaption($this->StatusFinishOrder);
					$doc->exportCaption($this->DateTimefinishOrder);
					$doc->exportCaption($this->CusomterOrderNo);
					$doc->exportCaption($this->InvoiceNo);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->ID_Order);
						$doc->exportField($this->OrderDate);
						$doc->exportField($this->ID_Contact);
						$doc->exportField($this->StatusLoad);
						$doc->exportField($this->CreateUser);
						$doc->exportField($this->CreateDate);
						$doc->exportField($this->UpdateUser);
						$doc->exportField($this->UpdateDate);
						$doc->exportField($this->StatusFinishOrder);
						$doc->exportField($this->DateTimefinishOrder);
						$doc->exportField($this->UserFinishOrder);
						$doc->exportField($this->CusomterOrderNo);
						$doc->exportField($this->InvoiceNo);
					} else {
						$doc->exportField($this->ID_Order);
						$doc->exportField($this->OrderDate);
						$doc->exportField($this->ID_Contact);
						$doc->exportField($this->StatusLoad);
						$doc->exportField($this->StatusFinishOrder);
						$doc->exportField($this->DateTimefinishOrder);
						$doc->exportField($this->CusomterOrderNo);
						$doc->exportField($this->InvoiceNo);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Lookup data from table
	public function lookup()
	{
		global $Language, $LANGUAGE_FOLDER, $PROJECT_ID;
		if (!isset($Language))
			$Language = new Language($LANGUAGE_FOLDER, Post("language", ""));
		global $Security, $RequestSecurity;

		// Check token first
		$func = PROJECT_NAMESPACE . "CheckToken";
		$validRequest = FALSE;
		if (is_callable($func) && Post(TOKEN_NAME) !== NULL) {
			$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			if ($validRequest) {
				if (!isset($Security)) {
					if (session_status() !== PHP_SESSION_ACTIVE)
						session_start(); // Init session data
					$Security = new AdvancedSecurity();
					if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
					$Security->loadCurrentUserLevel($PROJECT_ID . $this->TableName);
					if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
					$validRequest = $Security->canList(); // List permission
					if ($validRequest) {
						$Security->UserID_Loading();
						$Security->loadUserID();
						$Security->UserID_Loaded();
					}
				}
			}
		} else {

			// User profile
			$UserProfile = new UserProfile();

			// Security
			$Security = new AdvancedSecurity();
			if (is_array($RequestSecurity)) // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
			$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel(CurrentProjectID() . $this->TableName);
			$Security->TablePermission_Loaded();
			$validRequest = $Security->canList(); // List permission
		}

		// Reject invalid request
		if (!$validRequest)
			return FALSE;

		// Load lookup parameters
		$distinct = ConvertToBool(Post("distinct"));
		$linkField = Post("linkField");
		$displayFields = Post("displayFields");
		$parentFields = Post("parentFields");
		if (!is_array($parentFields))
			$parentFields = [];
		$childFields = Post("childFields");
		if (!is_array($childFields))
			$childFields = [];
		$filterFields = Post("filterFields");
		if (!is_array($filterFields))
			$filterFields = [];
		$filterFieldVars = Post("filterFieldVars");
		if (!is_array($filterFieldVars))
			$filterFieldVars = [];
		$filterOperators = Post("filterOperators");
		if (!is_array($filterOperators))
			$filterOperators = [];
		$autoFillSourceFields = Post("autoFillSourceFields");
		if (!is_array($autoFillSourceFields))
			$autoFillSourceFields = [];
		$formatAutoFill = FALSE;
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = AUTO_SUGGEST_MAX_ENTRIES;
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");

		// Selected records from modal, skip parent/filter fields and show all records
		if ($keys !== NULL) {
			$parentFields = [];
			$filterFields = [];
			$filterFieldVars = [];
			$offset = 0;
			$pageSize = 0;
		}

		// Create lookup object and output JSON
		$lookup = new Lookup($linkField, $this->TableVar, $distinct, $linkField, $displayFields, $parentFields, $childFields, $filterFields, $filterFieldVars, $autoFillSourceFields);
		foreach ($filterFields as $i => $filterField) { // Set up filter operators
			if (@$filterOperators[$i] <> "")
				$lookup->setFilterOperator($filterField, $filterOperators[$i]);
		}
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(LOOKUP_FILTER_VALUE_SEPARATOR, $keys);
			$lookup->FilterValues[] = $keys; // Lookup values
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($filterFields) ? count($filterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect <> "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter <> "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy <> "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson();
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = THUMBNAIL_DEFAULT_WIDTH, $height = THUMBNAIL_DEFAULT_HEIGHT)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>