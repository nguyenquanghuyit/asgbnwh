<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Table class for vwguidepicking
 */
class vwguidepicking extends DbTable
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

	// Audit trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Export
	public $ExportDoc;

	// Fields
	public $ID_Guide;
	public $ID_Order;
	public $Code;
	public $ProductName;
	public $PalletID;
	public $PCS_In;
	public $PCS;
	public $ID_Location;
	public $DateIn;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'vwguidepicking';
		$this->TableName = 'vwguidepicking';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`vwguidepicking`";
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
		$this->BasicSearch->TypeDefault = "OR";

		// ID_Guide
		$this->ID_Guide = new DbField('vwguidepicking', 'vwguidepicking', 'x_ID_Guide', 'ID_Guide', '`ID_Guide`', '`ID_Guide`', 3, -1, FALSE, '`ID_Guide`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ID_Guide->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ID_Guide->IsPrimaryKey = TRUE; // Primary key field
		$this->ID_Guide->Sortable = TRUE; // Allow sort
		$this->ID_Guide->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Guide'] = &$this->ID_Guide;

		// ID_Order
		$this->ID_Order = new DbField('vwguidepicking', 'vwguidepicking', 'x_ID_Order', 'ID_Order', '`ID_Order`', '`ID_Order`', 3, -1, FALSE, '`ID_Order`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_Order->Sortable = TRUE; // Allow sort
		$this->ID_Order->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Order'] = &$this->ID_Order;

		// Code
		$this->Code = new DbField('vwguidepicking', 'vwguidepicking', 'x_Code', 'Code', '`Code`', '`Code`', 200, -1, FALSE, '`Code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Code->Sortable = TRUE; // Allow sort
		$this->fields['Code'] = &$this->Code;

		// ProductName
		$this->ProductName = new DbField('vwguidepicking', 'vwguidepicking', 'x_ProductName', 'ProductName', '`ProductName`', '`ProductName`', 200, -1, FALSE, '`ProductName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProductName->Sortable = TRUE; // Allow sort
		$this->fields['ProductName'] = &$this->ProductName;

		// PalletID
		$this->PalletID = new DbField('vwguidepicking', 'vwguidepicking', 'x_PalletID', 'PalletID', '`PalletID`', '`PalletID`', 200, -1, FALSE, '`PalletID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PalletID->Sortable = TRUE; // Allow sort
		$this->fields['PalletID'] = &$this->PalletID;

		// PCS_In
		$this->PCS_In = new DbField('vwguidepicking', 'vwguidepicking', 'x_PCS_In', 'PCS_In', '`PCS_In`', '`PCS_In`', 3, -1, FALSE, '`PCS_In`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PCS_In->Sortable = TRUE; // Allow sort
		$this->PCS_In->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PCS_In'] = &$this->PCS_In;

		// PCS
		$this->PCS = new DbField('vwguidepicking', 'vwguidepicking', 'x_PCS', 'PCS', '`PCS`', '`PCS`', 3, -1, FALSE, '`PCS`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PCS->Sortable = TRUE; // Allow sort
		$this->PCS->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PCS'] = &$this->PCS;

		// ID_Location
		$this->ID_Location = new DbField('vwguidepicking', 'vwguidepicking', 'x_ID_Location', 'ID_Location', '`ID_Location`', '`ID_Location`', 3, -1, FALSE, '`EV__ID_Location`', TRUE, FALSE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_Location->Sortable = TRUE; // Allow sort
		$this->ID_Location->Lookup = new Lookup('ID_Location', 'tbl_location', FALSE, 'ID_Location', ["Location","","",""], [], [], [], [], [], [], '', '');
		$this->ID_Location->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Location'] = &$this->ID_Location;

		// DateIn
		$this->DateIn = new DbField('vwguidepicking', 'vwguidepicking', 'x_DateIn', 'DateIn', '`DateIn`', CastDateFieldForLike('`DateIn`', 11, "DB"), 135, 11, FALSE, '`DateIn`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateIn->Sortable = TRUE; // Allow sort
		$this->DateIn->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->fields['DateIn'] = &$this->DateIn;
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
			$sortFieldList = ($fld->VirtualExpression <> "") ? $fld->VirtualExpression : $sortField;
			if ($ctrl) {
				$orderByList = $this->getSessionOrderByList();
				if (ContainsString($orderByList, $sortFieldList . " " . $lastSort)) {
					$orderByList = str_replace($sortFieldList . " " . $lastSort, $sortFieldList . " " . $thisSort, $orderByList);
				} else {
					if ($orderByList <> "") $orderByList .= ", ";
					$orderByList .= $sortFieldList . " " . $thisSort;
				}
				$this->setSessionOrderByList($orderByList); // Save to Session
			} else {
				$this->setSessionOrderByList($sortFieldList . " " . $thisSort); // Save to Session
			}
		} else {
			if (!$ctrl)
				$fld->setSort("");
		}
	}

	// Session ORDER BY for List page
	public function getSessionOrderByList()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_ORDER_BY_LIST];
	}
	public function setSessionOrderByList($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_ORDER_BY_LIST] = $v;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`vwguidepicking`";
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
	public function getSqlSelectList() // Select for List page
	{
		$select = "";
		$select = "SELECT * FROM (" .
			"SELECT *, (SELECT `Location` FROM `tbl_location` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`ID_Location` = `vwguidepicking`.`ID_Location` LIMIT 1) AS `EV__ID_Location` FROM `vwguidepicking`" .
			") `TMP_TABLE`";
		return ($this->SqlSelectList <> "") ? $this->SqlSelectList : $select;
	}
	public function sqlSelectList() // For backward compatibility
	{
		return $this->getSqlSelectList();
	}
	public function setSqlSelectList($v)
	{
		$this->SqlSelectList = $v;
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
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "`ID_Order` DESC,`PalletID` ASC,`DateIn` ASC";
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
		if ($this->useVirtualFields()) {
			$select = $this->getSqlSelectList();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		} else {
			$select = $this->getSqlSelect();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		}
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = ($this->useVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Check if virtual fields is used in SQL
	protected function useVirtualFields()
	{
		$where = $this->UseSessionForListSql ? $this->getSessionWhere() : $this->CurrentFilter;
		$orderBy = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		if ($where <> "")
			$where = " " . str_replace(array("(",")"), array("",""), $where) . " ";
		if ($orderBy <> "")
			$orderBy = " " . str_replace(array("(",")"), array("",""), $orderBy) . " ";
		if ($this->BasicSearch->getKeyword() <> "")
			return TRUE;
		if ($this->ID_Location->AdvancedSearch->SearchValue <> "" ||
			$this->ID_Location->AdvancedSearch->SearchValue2 <> "" ||
			ContainsString($where, " " . $this->ID_Location->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->ID_Location->VirtualExpression . " "))
			return TRUE;
		return FALSE;
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
		if ($this->useVirtualFields())
			$sql = BuildSelectSql($this->getSqlSelectList(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		else
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
			$this->ID_Guide->setDbValue($conn->insert_ID());
			$rs['ID_Guide'] = $this->ID_Guide->DbValue;
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailOnAdd($rs);
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
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'ID_Guide';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$this->writeAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('ID_Guide', $rs))
				AddFilter($where, QuotedName('ID_Guide', $this->Dbid) . '=' . QuotedValue($rs['ID_Guide'], $this->ID_Guide->DataType, $this->Dbid));
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
		if ($success && $this->AuditTrailOnDelete)
			$this->writeAuditTrailOnDelete($rs);
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->ID_Guide->DbValue = $row['ID_Guide'];
		$this->ID_Order->DbValue = $row['ID_Order'];
		$this->Code->DbValue = $row['Code'];
		$this->ProductName->DbValue = $row['ProductName'];
		$this->PalletID->DbValue = $row['PalletID'];
		$this->PCS_In->DbValue = $row['PCS_In'];
		$this->PCS->DbValue = $row['PCS'];
		$this->ID_Location->DbValue = $row['ID_Location'];
		$this->DateIn->DbValue = $row['DateIn'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ID_Guide` = @ID_Guide@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('ID_Guide', $row) ? $row['ID_Guide'] : NULL) : $this->ID_Guide->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ID_Guide@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "vwguidepickinglist.php";
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
		if ($pageName == "vwguidepickingview.php")
			return $Language->phrase("View");
		elseif ($pageName == "vwguidepickingedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "vwguidepickingadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "vwguidepickinglist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("vwguidepickingview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("vwguidepickingview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "vwguidepickingadd.php?" . $this->getUrlParm($parm);
		else
			$url = "vwguidepickingadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("vwguidepickingedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("vwguidepickingadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("vwguidepickingdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ID_Guide:" . JsonEncode($this->ID_Guide->CurrentValue, "number");
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
		if ($this->ID_Guide->CurrentValue != NULL) {
			$url .= "ID_Guide=" . urlencode($this->ID_Guide->CurrentValue);
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
			if (Param("ID_Guide") !== NULL)
				$arKeys[] = Param("ID_Guide");
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
			$this->ID_Guide->CurrentValue = $key;
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
		$this->ID_Guide->setDbValue($rs->fields('ID_Guide'));
		$this->ID_Order->setDbValue($rs->fields('ID_Order'));
		$this->Code->setDbValue($rs->fields('Code'));
		$this->ProductName->setDbValue($rs->fields('ProductName'));
		$this->PalletID->setDbValue($rs->fields('PalletID'));
		$this->PCS_In->setDbValue($rs->fields('PCS_In'));
		$this->PCS->setDbValue($rs->fields('PCS'));
		$this->ID_Location->setDbValue($rs->fields('ID_Location'));
		$this->DateIn->setDbValue($rs->fields('DateIn'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ID_Guide

		$this->ID_Guide->CellCssStyle = "white-space: nowrap;";

		// ID_Order
		$this->ID_Order->CellCssStyle = "white-space: nowrap;";

		// Code
		$this->Code->CellCssStyle = "white-space: nowrap;";

		// ProductName
		$this->ProductName->CellCssStyle = "white-space: nowrap;";

		// PalletID
		$this->PalletID->CellCssStyle = "white-space: nowrap;";

		// PCS_In
		$this->PCS_In->CellCssStyle = "white-space: nowrap;";

		// PCS
		$this->PCS->CellCssStyle = "white-space: nowrap;";

		// ID_Location
		$this->ID_Location->CellCssStyle = "white-space: nowrap;";

		// DateIn
		$this->DateIn->CellCssStyle = "white-space: nowrap;";

		// ID_Guide
		$this->ID_Guide->ViewValue = $this->ID_Guide->CurrentValue;
		$this->ID_Guide->ViewCustomAttributes = "";

		// ID_Order
		$this->ID_Order->ViewValue = $this->ID_Order->CurrentValue;
		$this->ID_Order->ViewValue = FormatNumber($this->ID_Order->ViewValue, 0, -2, -2, -2);
		$this->ID_Order->CssClass = "font-weight-bold";
		$this->ID_Order->CellCssStyle .= "text-align: center;";
		$this->ID_Order->ViewCustomAttributes = "";

		// Code
		$this->Code->ViewValue = $this->Code->CurrentValue;
		$this->Code->CssClass = "font-weight-bold";
		$this->Code->ViewCustomAttributes = "";

		// ProductName
		$this->ProductName->ViewValue = $this->ProductName->CurrentValue;
		$this->ProductName->ViewCustomAttributes = "";

		// PalletID
		$this->PalletID->ViewValue = $this->PalletID->CurrentValue;
		$this->PalletID->CssClass = "font-weight-bold";
		$this->PalletID->ViewCustomAttributes = "";

		// PCS_In
		$this->PCS_In->ViewValue = $this->PCS_In->CurrentValue;
		$this->PCS_In->ViewValue = FormatNumber($this->PCS_In->ViewValue, 0, -2, -2, -2);
		$this->PCS_In->CellCssStyle .= "text-align: right;";
		$this->PCS_In->ViewCustomAttributes = "";

		// PCS
		$this->PCS->ViewValue = $this->PCS->CurrentValue;
		$this->PCS->ViewValue = FormatNumber($this->PCS->ViewValue, 0, -2, -2, -2);
		$this->PCS->CellCssStyle .= "text-align: right;";
		$this->PCS->ViewCustomAttributes = "";

		// ID_Location
		if ($this->ID_Location->VirtualValue <> "") {
			$this->ID_Location->ViewValue = $this->ID_Location->VirtualValue;
		} else {
			$this->ID_Location->ViewValue = $this->ID_Location->CurrentValue;
		$curVal = strval($this->ID_Location->CurrentValue);
		if ($curVal <> "") {
			$this->ID_Location->ViewValue = $this->ID_Location->lookupCacheOption($curVal);
			if ($this->ID_Location->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ID_Location`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ID_Location->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$this->ID_Location->ViewValue = $this->ID_Location->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ID_Location->ViewValue = $this->ID_Location->CurrentValue;
				}
			}
		} else {
			$this->ID_Location->ViewValue = NULL;
		}
		}
		$this->ID_Location->CellCssStyle .= "text-align: left;";
		$this->ID_Location->ViewCustomAttributes = "";

		// DateIn
		$this->DateIn->ViewValue = $this->DateIn->CurrentValue;
		$this->DateIn->ViewValue = FormatDateTime($this->DateIn->ViewValue, 11);
		$this->DateIn->ViewCustomAttributes = "";

		// ID_Guide
		$this->ID_Guide->LinkCustomAttributes = "";
		$this->ID_Guide->HrefValue = "";
		$this->ID_Guide->TooltipValue = "";

		// ID_Order
		$this->ID_Order->LinkCustomAttributes = "";
		$this->ID_Order->HrefValue = "";
		$this->ID_Order->TooltipValue = "";

		// Code
		$this->Code->LinkCustomAttributes = "";
		$this->Code->HrefValue = "";
		$this->Code->TooltipValue = "";

		// ProductName
		$this->ProductName->LinkCustomAttributes = "";
		$this->ProductName->HrefValue = "";
		$this->ProductName->TooltipValue = "";

		// PalletID
		$this->PalletID->LinkCustomAttributes = "";
		$this->PalletID->HrefValue = "";
		$this->PalletID->TooltipValue = "";

		// PCS_In
		$this->PCS_In->LinkCustomAttributes = "";
		$this->PCS_In->HrefValue = "";
		$this->PCS_In->TooltipValue = "";

		// PCS
		$this->PCS->LinkCustomAttributes = "";
		$this->PCS->HrefValue = "";
		$this->PCS->TooltipValue = "";

		// ID_Location
		$this->ID_Location->LinkCustomAttributes = "";
		$this->ID_Location->HrefValue = "";
		$this->ID_Location->TooltipValue = "";

		// DateIn
		$this->DateIn->LinkCustomAttributes = "";
		$this->DateIn->HrefValue = "";
		$this->DateIn->TooltipValue = "";

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

		// ID_Guide
		$this->ID_Guide->EditAttrs["class"] = "form-control";
		$this->ID_Guide->EditCustomAttributes = "";
		$this->ID_Guide->EditValue = $this->ID_Guide->CurrentValue;
		$this->ID_Guide->ViewCustomAttributes = "";

		// ID_Order
		$this->ID_Order->EditAttrs["class"] = "form-control";
		$this->ID_Order->EditCustomAttributes = "";
		$this->ID_Order->EditValue = $this->ID_Order->CurrentValue;
		$this->ID_Order->PlaceHolder = RemoveHtml($this->ID_Order->caption());

		// Code
		$this->Code->EditAttrs["class"] = "form-control";
		$this->Code->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->Code->CurrentValue = HtmlDecode($this->Code->CurrentValue);
		$this->Code->EditValue = $this->Code->CurrentValue;
		$this->Code->PlaceHolder = RemoveHtml($this->Code->caption());

		// ProductName
		$this->ProductName->EditAttrs["class"] = "form-control";
		$this->ProductName->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->ProductName->CurrentValue = HtmlDecode($this->ProductName->CurrentValue);
		$this->ProductName->EditValue = $this->ProductName->CurrentValue;
		$this->ProductName->PlaceHolder = RemoveHtml($this->ProductName->caption());

		// PalletID
		$this->PalletID->EditAttrs["class"] = "form-control";
		$this->PalletID->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->PalletID->CurrentValue = HtmlDecode($this->PalletID->CurrentValue);
		$this->PalletID->EditValue = $this->PalletID->CurrentValue;
		$this->PalletID->PlaceHolder = RemoveHtml($this->PalletID->caption());

		// PCS_In
		$this->PCS_In->EditAttrs["class"] = "form-control";
		$this->PCS_In->EditCustomAttributes = "";
		$this->PCS_In->EditValue = $this->PCS_In->CurrentValue;
		$this->PCS_In->PlaceHolder = RemoveHtml($this->PCS_In->caption());

		// PCS
		$this->PCS->EditAttrs["class"] = "form-control";
		$this->PCS->EditCustomAttributes = "";
		$this->PCS->EditValue = $this->PCS->CurrentValue;
		$this->PCS->PlaceHolder = RemoveHtml($this->PCS->caption());

		// ID_Location
		$this->ID_Location->EditAttrs["class"] = "form-control";
		$this->ID_Location->EditCustomAttributes = "";
		$this->ID_Location->EditValue = $this->ID_Location->CurrentValue;
		$this->ID_Location->PlaceHolder = RemoveHtml($this->ID_Location->caption());

		// DateIn
		$this->DateIn->EditAttrs["class"] = "form-control";
		$this->DateIn->EditCustomAttributes = "";
		$this->DateIn->EditValue = FormatDateTime($this->DateIn->CurrentValue, 11);
		$this->DateIn->PlaceHolder = RemoveHtml($this->DateIn->caption());

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
					$doc->exportCaption($this->Code);
					$doc->exportCaption($this->ProductName);
					$doc->exportCaption($this->PalletID);
					$doc->exportCaption($this->PCS_In);
					$doc->exportCaption($this->PCS);
					$doc->exportCaption($this->ID_Location);
					$doc->exportCaption($this->DateIn);
				} else {
					$doc->exportCaption($this->ID_Order);
					$doc->exportCaption($this->Code);
					$doc->exportCaption($this->ProductName);
					$doc->exportCaption($this->PalletID);
					$doc->exportCaption($this->PCS_In);
					$doc->exportCaption($this->PCS);
					$doc->exportCaption($this->ID_Location);
					$doc->exportCaption($this->DateIn);
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
						$doc->exportField($this->Code);
						$doc->exportField($this->ProductName);
						$doc->exportField($this->PalletID);
						$doc->exportField($this->PCS_In);
						$doc->exportField($this->PCS);
						$doc->exportField($this->ID_Location);
						$doc->exportField($this->DateIn);
					} else {
						$doc->exportField($this->ID_Order);
						$doc->exportField($this->Code);
						$doc->exportField($this->ProductName);
						$doc->exportField($this->PalletID);
						$doc->exportField($this->PCS_In);
						$doc->exportField($this->PCS);
						$doc->exportField($this->ID_Location);
						$doc->exportField($this->DateIn);
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

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'vwguidepicking';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'vwguidepicking';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['ID_Guide'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$newvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
	{
		global $Language;
		if (!$this->AuditTrailOnEdit)
			return;
		$table = 'vwguidepicking';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['ID_Guide'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->DataType == DATATYPE_DATE) { // DateTime field
					$modified = (FormatDateTime($rsold[$fldname], 0) <> FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->phrase("PasswordMask");
						$newvalue = $Language->phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) { // Memo field
						if (AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	public function writeAuditTrailOnDelete(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnDelete)
			return;
		$table = 'vwguidepicking';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['ID_Guide'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$oldvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
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