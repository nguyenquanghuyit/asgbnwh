<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Page class
 */
class tbl_order_edit extends tbl_order
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{004E2122-9CCA-46AA-835C-0778C5A080BC}";

	// Table name
	public $TableName = 'tbl_order';

	// Page object name
	public $PageObjName = "tbl_order_edit";

	// Audit Trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken = CHECK_TOKEN;

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Page URL
	private $_pageUrl = "";

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		if ($this->_pageUrl == "") {
			$this->_pageUrl = CurrentPageName() . "?";
			if ($this->UseTokenInUrl)
				$this->_pageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		}
		return $this->_pageUrl;
	}

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message <> "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fa fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fa fa-warning"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage <> "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fa fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fa fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = array();

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message <> "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage <> "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage <> "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage <> "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header <> "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer <> "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(TOKEN_NAME) === NULL)
			return FALSE;
		$fn = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
		if (is_callable($fn))
			return $fn(Post(TOKEN_NAME), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = PROJECT_NAMESPACE . CREATE_TOKEN_FUNC; // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $COMPOSITE_KEY_SEPARATOR;
		global $UserTable, $UserTableConn;

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (tbl_order)
		if (!isset($GLOBALS["tbl_order"]) || get_class($GLOBALS["tbl_order"]) == PROJECT_NAMESPACE . "tbl_order") {
			$GLOBALS["tbl_order"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_order"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (tbl_user)
		if (!isset($GLOBALS['tbl_user']))
			$GLOBALS['tbl_user'] = new tbl_user();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tbl_order');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = &$this->getConnection();

		// User table object (tbl_user)
		if (!isset($UserTable)) {
			$UserTable = new tbl_user();
			$UserTableConn = Conn($UserTable->Dbid);
		}
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EXPORT, $tbl_order;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_order);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url <> "") {
			if (!DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "tbl_orderview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = array();
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = array();
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {

								//$url = FullUrl($fld->TableVar . "/" . API_FILE_ACTION . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))); // URL rewrite format
								$url = FullUrl(GetPageName(API_URL) . "?" . API_OBJECT_NAME . "=" . $fld->TableVar . "&" . API_ACTION_NAME . "=" . API_FILE_ACTION . "&" . API_FIELD_NAME . "=" . $fld->Param . "&" . API_KEY_NAME . "=" . rawurlencode($this->getRecordKeyValue($ar))); // Query string format
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, MULTIPLE_UPLOAD_SEPARATOR)) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['ID_Order'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->ID_Order->Visible = FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $DetailPages; // Detail pages object

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		$Security = new AdvancedSecurity();
		$validRequest = FALSE;

		// Check security for API request
		If (IsApi()) {

			// Check token first
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Post(TOKEN_NAME) !== NULL)
				$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			elseif (is_array($RequestSecurity) && @$RequestSecurity["username"] <> "") // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
		}
		if (!$validRequest) {
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("tbl_orderlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ID_Order->setVisibility();
		$this->OrderDate->setVisibility();
		$this->InvoiceNo->setVisibility();
		$this->CusomterOrderNo->setVisibility();
		$this->IdType->setVisibility();
		$this->ID_Contact->setVisibility();
		$this->CreateUser->setVisibility();
		$this->CreateDate->setVisibility();
		$this->StatusLoad->setVisibility();
		$this->StatusFinishOrder->setVisibility();
		$this->DateTimefinishOrder->Visible = FALSE;
		$this->UserFinishOrder->Visible = FALSE;
		$this->UpdateDate->Visible = FALSE;
		$this->UpdateUser->Visible = FALSE;
		$this->PrintSubLable->Visible = FALSE;
		$this->Packing->Visible = FALSE;
		$this->FinishPacking->Visible = FALSE;
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Set up detail page object
		$this->setupDetailPages();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->IdType);
		$this->setupLookupOptions($this->ID_Contact);

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get action code
			if (!$this->isShow()) // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($CurrentForm->hasValue("x_ID_Order")) {
				$this->ID_Order->setFormValue($CurrentForm->getValue("x_ID_Order"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("ID_Order") !== NULL) {
				$this->ID_Order->setQueryStringValue(Get("ID_Order"));
				$loadByQuery = TRUE;
			} else {
				$this->ID_Order->CurrentValue = NULL;
			}
		}

		// Load current record
		$loaded = $this->loadRow();

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values

			// Set up detail parameters
			$this->setupDetailParms();
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("tbl_orderlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "update": // Update
				if ($this->getCurrentDetailTable() <> "") // Master/detail edit
					$returnUrl = $this->getViewUrl(TABLE_SHOW_DETAIL . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "tbl_orderlist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed

					// Set up detail parameters
					$this->setupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Set up starting record parameters
	public function setupStartRec()
	{
		if ($this->DisplayRecs == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			if (Get(TABLE_START_REC) !== NULL) { // Check for "start" parameter
				$this->StartRec = Get(TABLE_START_REC);
				$this->setStartRecordNumber($this->StartRec);
			} elseif (Get(TABLE_PAGE_NO) !== NULL) {
				$pageNo = Get(TABLE_PAGE_NO);
				if (is_numeric($pageNo)) {
					$this->StartRec = ($pageNo - 1) * $this->DisplayRecs + 1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1) {
						$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->StartRec > $this->TotalRecs) { // Avoid starting record > total records
			$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec - 1) % $this->DisplayRecs <> 0) {
			$this->StartRec = (int)(($this->StartRec - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'ID_Order' first before field var 'x_ID_Order'
		$val = $CurrentForm->hasValue("ID_Order") ? $CurrentForm->getValue("ID_Order") : $CurrentForm->getValue("x_ID_Order");
		if (!$this->ID_Order->IsDetailKey)
			$this->ID_Order->setFormValue($val);

		// Check field name 'OrderDate' first before field var 'x_OrderDate'
		$val = $CurrentForm->hasValue("OrderDate") ? $CurrentForm->getValue("OrderDate") : $CurrentForm->getValue("x_OrderDate");
		if (!$this->OrderDate->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->OrderDate->Visible = FALSE; // Disable update for API request
			else
				$this->OrderDate->setFormValue($val);
			$this->OrderDate->CurrentValue = UnFormatDateTime($this->OrderDate->CurrentValue, 7);
		}

		// Check field name 'InvoiceNo' first before field var 'x_InvoiceNo'
		$val = $CurrentForm->hasValue("InvoiceNo") ? $CurrentForm->getValue("InvoiceNo") : $CurrentForm->getValue("x_InvoiceNo");
		if (!$this->InvoiceNo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->InvoiceNo->Visible = FALSE; // Disable update for API request
			else
				$this->InvoiceNo->setFormValue($val);
		}

		// Check field name 'CusomterOrderNo' first before field var 'x_CusomterOrderNo'
		$val = $CurrentForm->hasValue("CusomterOrderNo") ? $CurrentForm->getValue("CusomterOrderNo") : $CurrentForm->getValue("x_CusomterOrderNo");
		if (!$this->CusomterOrderNo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CusomterOrderNo->Visible = FALSE; // Disable update for API request
			else
				$this->CusomterOrderNo->setFormValue($val);
		}

		// Check field name 'IdType' first before field var 'x_IdType'
		$val = $CurrentForm->hasValue("IdType") ? $CurrentForm->getValue("IdType") : $CurrentForm->getValue("x_IdType");
		if (!$this->IdType->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->IdType->Visible = FALSE; // Disable update for API request
			else
				$this->IdType->setFormValue($val);
		}

		// Check field name 'ID_Contact' first before field var 'x_ID_Contact'
		$val = $CurrentForm->hasValue("ID_Contact") ? $CurrentForm->getValue("ID_Contact") : $CurrentForm->getValue("x_ID_Contact");
		if (!$this->ID_Contact->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Contact->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Contact->setFormValue($val);
		}

		// Check field name 'CreateUser' first before field var 'x_CreateUser'
		$val = $CurrentForm->hasValue("CreateUser") ? $CurrentForm->getValue("CreateUser") : $CurrentForm->getValue("x_CreateUser");
		if (!$this->CreateUser->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CreateUser->Visible = FALSE; // Disable update for API request
			else
				$this->CreateUser->setFormValue($val);
		}

		// Check field name 'CreateDate' first before field var 'x_CreateDate'
		$val = $CurrentForm->hasValue("CreateDate") ? $CurrentForm->getValue("CreateDate") : $CurrentForm->getValue("x_CreateDate");
		if (!$this->CreateDate->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CreateDate->Visible = FALSE; // Disable update for API request
			else
				$this->CreateDate->setFormValue($val);
			$this->CreateDate->CurrentValue = UnFormatDateTime($this->CreateDate->CurrentValue, 11);
		}

		// Check field name 'StatusLoad' first before field var 'x_StatusLoad'
		$val = $CurrentForm->hasValue("StatusLoad") ? $CurrentForm->getValue("StatusLoad") : $CurrentForm->getValue("x_StatusLoad");
		if (!$this->StatusLoad->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->StatusLoad->Visible = FALSE; // Disable update for API request
			else
				$this->StatusLoad->setFormValue($val);
		}

		// Check field name 'StatusFinishOrder' first before field var 'x_StatusFinishOrder'
		$val = $CurrentForm->hasValue("StatusFinishOrder") ? $CurrentForm->getValue("StatusFinishOrder") : $CurrentForm->getValue("x_StatusFinishOrder");
		if (!$this->StatusFinishOrder->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->StatusFinishOrder->Visible = FALSE; // Disable update for API request
			else
				$this->StatusFinishOrder->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ID_Order->CurrentValue = $this->ID_Order->FormValue;
		$this->OrderDate->CurrentValue = $this->OrderDate->FormValue;
		$this->OrderDate->CurrentValue = UnFormatDateTime($this->OrderDate->CurrentValue, 7);
		$this->InvoiceNo->CurrentValue = $this->InvoiceNo->FormValue;
		$this->CusomterOrderNo->CurrentValue = $this->CusomterOrderNo->FormValue;
		$this->IdType->CurrentValue = $this->IdType->FormValue;
		$this->ID_Contact->CurrentValue = $this->ID_Contact->FormValue;
		$this->CreateUser->CurrentValue = $this->CreateUser->FormValue;
		$this->CreateDate->CurrentValue = $this->CreateDate->FormValue;
		$this->CreateDate->CurrentValue = UnFormatDateTime($this->CreateDate->CurrentValue, 11);
		$this->StatusLoad->CurrentValue = $this->StatusLoad->FormValue;
		$this->StatusFinishOrder->CurrentValue = $this->StatusFinishOrder->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->ID_Order->setDbValue($row['ID_Order']);
		$this->OrderDate->setDbValue($row['OrderDate']);
		$this->InvoiceNo->setDbValue($row['InvoiceNo']);
		$this->CusomterOrderNo->setDbValue($row['CusomterOrderNo']);
		$this->IdType->setDbValue($row['IdType']);
		$this->ID_Contact->setDbValue($row['ID_Contact']);
		if (array_key_exists('EV__ID_Contact', $rs->fields)) {
			$this->ID_Contact->VirtualValue = $rs->fields('EV__ID_Contact'); // Set up virtual field value
		} else {
			$this->ID_Contact->VirtualValue = ""; // Clear value
		}
		$this->CreateUser->setDbValue($row['CreateUser']);
		$this->CreateDate->setDbValue($row['CreateDate']);
		$this->StatusLoad->setDbValue($row['StatusLoad']);
		$this->StatusFinishOrder->setDbValue($row['StatusFinishOrder']);
		$this->DateTimefinishOrder->setDbValue($row['DateTimefinishOrder']);
		$this->UserFinishOrder->setDbValue($row['UserFinishOrder']);
		$this->UpdateDate->setDbValue($row['UpdateDate']);
		$this->UpdateUser->setDbValue($row['UpdateUser']);
		$this->PrintSubLable->setDbValue($row['PrintSubLable']);
		$this->Packing->setDbValue($row['Packing']);
		$this->FinishPacking->setDbValue($row['FinishPacking']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['ID_Order'] = NULL;
		$row['OrderDate'] = NULL;
		$row['InvoiceNo'] = NULL;
		$row['CusomterOrderNo'] = NULL;
		$row['IdType'] = NULL;
		$row['ID_Contact'] = NULL;
		$row['CreateUser'] = NULL;
		$row['CreateDate'] = NULL;
		$row['StatusLoad'] = NULL;
		$row['StatusFinishOrder'] = NULL;
		$row['DateTimefinishOrder'] = NULL;
		$row['UserFinishOrder'] = NULL;
		$row['UpdateDate'] = NULL;
		$row['UpdateUser'] = NULL;
		$row['PrintSubLable'] = NULL;
		$row['Packing'] = NULL;
		$row['FinishPacking'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ID_Order")) <> "")
			$this->ID_Order->CurrentValue = $this->getKey("ID_Order"); // ID_Order
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// ID_Order
		// OrderDate
		// InvoiceNo
		// CusomterOrderNo
		// IdType
		// ID_Contact
		// CreateUser
		// CreateDate
		// StatusLoad
		// StatusFinishOrder
		// DateTimefinishOrder
		// UserFinishOrder
		// UpdateDate
		// UpdateUser
		// PrintSubLable
		// Packing
		// FinishPacking

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ID_Order
			$this->ID_Order->ViewValue = $this->ID_Order->CurrentValue;
			$this->ID_Order->CssClass = "font-weight-bold";
			$this->ID_Order->CellCssStyle .= "text-align: center;";
			$this->ID_Order->ViewCustomAttributes = "";

			// OrderDate
			$this->OrderDate->ViewValue = $this->OrderDate->CurrentValue;
			$this->OrderDate->ViewValue = FormatDateTime($this->OrderDate->ViewValue, 7);
			$this->OrderDate->CellCssStyle .= "text-align: center;";
			$this->OrderDate->ViewCustomAttributes = "";

			// InvoiceNo
			$this->InvoiceNo->ViewValue = $this->InvoiceNo->CurrentValue;
			$this->InvoiceNo->ViewCustomAttributes = "";

			// CusomterOrderNo
			$this->CusomterOrderNo->ViewValue = $this->CusomterOrderNo->CurrentValue;
			$this->CusomterOrderNo->ViewCustomAttributes = "";

			// IdType
			$curVal = strval($this->IdType->CurrentValue);
			if ($curVal <> "") {
				$this->IdType->ViewValue = $this->IdType->lookupCacheOption($curVal);
				if ($this->IdType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`IdType`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->IdType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->IdType->ViewValue = $this->IdType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->IdType->ViewValue = $this->IdType->CurrentValue;
					}
				}
			} else {
				$this->IdType->ViewValue = NULL;
			}
			$this->IdType->CssClass = "font-weight-bold";
			$this->IdType->CellCssStyle .= "text-align: center;";
			$this->IdType->ViewCustomAttributes = "";

			// ID_Contact
			if ($this->ID_Contact->VirtualValue <> "") {
				$this->ID_Contact->ViewValue = $this->ID_Contact->VirtualValue;
			} else {
				$this->ID_Contact->ViewValue = $this->ID_Contact->CurrentValue;
			$curVal = strval($this->ID_Contact->CurrentValue);
			if ($curVal <> "") {
				$this->ID_Contact->ViewValue = $this->ID_Contact->lookupCacheOption($curVal);
				if ($this->ID_Contact->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ID_Contact`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ID_Contact->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->ID_Contact->ViewValue = $this->ID_Contact->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ID_Contact->ViewValue = $this->ID_Contact->CurrentValue;
					}
				}
			} else {
				$this->ID_Contact->ViewValue = NULL;
			}
			}
			$this->ID_Contact->ViewCustomAttributes = "";

			// CreateUser
			$this->CreateUser->ViewValue = $this->CreateUser->CurrentValue;
			$this->CreateUser->ViewCustomAttributes = "";

			// CreateDate
			$this->CreateDate->ViewValue = $this->CreateDate->CurrentValue;
			$this->CreateDate->ViewValue = FormatDateTime($this->CreateDate->ViewValue, 11);
			$this->CreateDate->ViewCustomAttributes = "";

			// StatusLoad
			if (strval($this->StatusLoad->CurrentValue) <> "") {
				$this->StatusLoad->ViewValue = $this->StatusLoad->optionCaption($this->StatusLoad->CurrentValue);
			} else {
				$this->StatusLoad->ViewValue = NULL;
			}
			$this->StatusLoad->CellCssStyle .= "text-align: center;";
			$this->StatusLoad->ViewCustomAttributes = "";

			// StatusFinishOrder
			if (strval($this->StatusFinishOrder->CurrentValue) <> "") {
				$this->StatusFinishOrder->ViewValue = $this->StatusFinishOrder->optionCaption($this->StatusFinishOrder->CurrentValue);
			} else {
				$this->StatusFinishOrder->ViewValue = NULL;
			}
			$this->StatusFinishOrder->CellCssStyle .= "text-align: center;";
			$this->StatusFinishOrder->ViewCustomAttributes = "";

			// ID_Order
			$this->ID_Order->LinkCustomAttributes = "";
			$this->ID_Order->HrefValue = "";
			$this->ID_Order->TooltipValue = "";

			// OrderDate
			$this->OrderDate->LinkCustomAttributes = "";
			$this->OrderDate->HrefValue = "";
			$this->OrderDate->TooltipValue = "";

			// InvoiceNo
			$this->InvoiceNo->LinkCustomAttributes = "";
			$this->InvoiceNo->HrefValue = "";
			$this->InvoiceNo->TooltipValue = "";

			// CusomterOrderNo
			$this->CusomterOrderNo->LinkCustomAttributes = "";
			$this->CusomterOrderNo->HrefValue = "";
			$this->CusomterOrderNo->TooltipValue = "";

			// IdType
			$this->IdType->LinkCustomAttributes = "";
			$this->IdType->HrefValue = "";
			$this->IdType->TooltipValue = "";

			// ID_Contact
			$this->ID_Contact->LinkCustomAttributes = "";
			$this->ID_Contact->HrefValue = "";
			$this->ID_Contact->TooltipValue = "";

			// CreateUser
			$this->CreateUser->LinkCustomAttributes = "";
			$this->CreateUser->HrefValue = "";
			$this->CreateUser->TooltipValue = "";

			// CreateDate
			$this->CreateDate->LinkCustomAttributes = "";
			$this->CreateDate->HrefValue = "";
			$this->CreateDate->TooltipValue = "";

			// StatusLoad
			$this->StatusLoad->LinkCustomAttributes = "";
			$this->StatusLoad->HrefValue = "";
			$this->StatusLoad->TooltipValue = "";

			// StatusFinishOrder
			$this->StatusFinishOrder->LinkCustomAttributes = "";
			$this->StatusFinishOrder->HrefValue = "";
			$this->StatusFinishOrder->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// ID_Order
			$this->ID_Order->EditAttrs["class"] = "form-control";
			$this->ID_Order->EditCustomAttributes = "";
			$this->ID_Order->EditValue = $this->ID_Order->CurrentValue;
			$this->ID_Order->CssClass = "font-weight-bold";
			$this->ID_Order->CellCssStyle .= "text-align: center;";
			$this->ID_Order->ViewCustomAttributes = "";

			// OrderDate
			$this->OrderDate->EditAttrs["class"] = "form-control";
			$this->OrderDate->EditCustomAttributes = "";
			$this->OrderDate->EditValue = HtmlEncode(FormatDateTime($this->OrderDate->CurrentValue, 7));
			$this->OrderDate->PlaceHolder = RemoveHtml($this->OrderDate->caption());

			// InvoiceNo
			$this->InvoiceNo->EditAttrs["class"] = "form-control";
			$this->InvoiceNo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->InvoiceNo->CurrentValue = HtmlDecode($this->InvoiceNo->CurrentValue);
			$this->InvoiceNo->EditValue = HtmlEncode($this->InvoiceNo->CurrentValue);
			$this->InvoiceNo->PlaceHolder = RemoveHtml($this->InvoiceNo->caption());

			// CusomterOrderNo
			$this->CusomterOrderNo->EditAttrs["class"] = "form-control";
			$this->CusomterOrderNo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->CusomterOrderNo->CurrentValue = HtmlDecode($this->CusomterOrderNo->CurrentValue);
			$this->CusomterOrderNo->EditValue = HtmlEncode($this->CusomterOrderNo->CurrentValue);
			$this->CusomterOrderNo->PlaceHolder = RemoveHtml($this->CusomterOrderNo->caption());

			// IdType
			$this->IdType->EditAttrs["class"] = "form-control";
			$this->IdType->EditCustomAttributes = "";
			$curVal = trim(strval($this->IdType->CurrentValue));
			if ($curVal <> "")
				$this->IdType->ViewValue = $this->IdType->lookupCacheOption($curVal);
			else
				$this->IdType->ViewValue = $this->IdType->Lookup !== NULL && is_array($this->IdType->Lookup->Options) ? $curVal : NULL;
			if ($this->IdType->ViewValue !== NULL) { // Load from cache
				$this->IdType->EditValue = array_values($this->IdType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`IdType`" . SearchString("=", $this->IdType->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->IdType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->IdType->EditValue = $arwrk;
			}

			// ID_Contact
			$this->ID_Contact->EditAttrs["class"] = "form-control";
			$this->ID_Contact->EditCustomAttributes = "";
			$this->ID_Contact->EditValue = HtmlEncode($this->ID_Contact->CurrentValue);
			$curVal = strval($this->ID_Contact->CurrentValue);
			if ($curVal <> "") {
				$this->ID_Contact->EditValue = $this->ID_Contact->lookupCacheOption($curVal);
				if ($this->ID_Contact->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ID_Contact`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ID_Contact->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->ID_Contact->EditValue = $this->ID_Contact->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ID_Contact->EditValue = HtmlEncode($this->ID_Contact->CurrentValue);
					}
				}
			} else {
				$this->ID_Contact->EditValue = NULL;
			}
			$this->ID_Contact->PlaceHolder = RemoveHtml($this->ID_Contact->caption());

			// CreateUser
			$this->CreateUser->EditAttrs["class"] = "form-control";
			$this->CreateUser->EditCustomAttributes = "";
			$this->CreateUser->EditValue = $this->CreateUser->CurrentValue;
			$this->CreateUser->ViewCustomAttributes = "";

			// CreateDate
			$this->CreateDate->EditAttrs["class"] = "form-control";
			$this->CreateDate->EditCustomAttributes = "";
			$this->CreateDate->EditValue = $this->CreateDate->CurrentValue;
			$this->CreateDate->EditValue = FormatDateTime($this->CreateDate->EditValue, 11);
			$this->CreateDate->ViewCustomAttributes = "";

			// StatusLoad
			$this->StatusLoad->EditAttrs["class"] = "form-control";
			$this->StatusLoad->EditCustomAttributes = "";
			$this->StatusLoad->EditValue = $this->StatusLoad->options(TRUE);

			// StatusFinishOrder
			$this->StatusFinishOrder->EditAttrs["class"] = "form-control";
			$this->StatusFinishOrder->EditCustomAttributes = "";
			$this->StatusFinishOrder->EditValue = $this->StatusFinishOrder->options(TRUE);

			// Edit refer script
			// ID_Order

			$this->ID_Order->LinkCustomAttributes = "";
			$this->ID_Order->HrefValue = "";
			$this->ID_Order->TooltipValue = "";

			// OrderDate
			$this->OrderDate->LinkCustomAttributes = "";
			$this->OrderDate->HrefValue = "";

			// InvoiceNo
			$this->InvoiceNo->LinkCustomAttributes = "";
			$this->InvoiceNo->HrefValue = "";

			// CusomterOrderNo
			$this->CusomterOrderNo->LinkCustomAttributes = "";
			$this->CusomterOrderNo->HrefValue = "";

			// IdType
			$this->IdType->LinkCustomAttributes = "";
			$this->IdType->HrefValue = "";

			// ID_Contact
			$this->ID_Contact->LinkCustomAttributes = "";
			$this->ID_Contact->HrefValue = "";

			// CreateUser
			$this->CreateUser->LinkCustomAttributes = "";
			$this->CreateUser->HrefValue = "";
			$this->CreateUser->TooltipValue = "";

			// CreateDate
			$this->CreateDate->LinkCustomAttributes = "";
			$this->CreateDate->HrefValue = "";
			$this->CreateDate->TooltipValue = "";

			// StatusLoad
			$this->StatusLoad->LinkCustomAttributes = "";
			$this->StatusLoad->HrefValue = "";

			// StatusFinishOrder
			$this->StatusFinishOrder->LinkCustomAttributes = "";
			$this->StatusFinishOrder->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->ID_Order->Required) {
			if (!$this->ID_Order->IsDetailKey && $this->ID_Order->FormValue != NULL && $this->ID_Order->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Order->caption(), $this->ID_Order->RequiredErrorMessage));
			}
		}
		if ($this->OrderDate->Required) {
			if (!$this->OrderDate->IsDetailKey && $this->OrderDate->FormValue != NULL && $this->OrderDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OrderDate->caption(), $this->OrderDate->RequiredErrorMessage));
			}
		}
		if (!CheckEuroDate($this->OrderDate->FormValue)) {
			AddMessage($FormError, $this->OrderDate->errorMessage());
		}
		if ($this->InvoiceNo->Required) {
			if (!$this->InvoiceNo->IsDetailKey && $this->InvoiceNo->FormValue != NULL && $this->InvoiceNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->InvoiceNo->caption(), $this->InvoiceNo->RequiredErrorMessage));
			}
		}
		if ($this->CusomterOrderNo->Required) {
			if (!$this->CusomterOrderNo->IsDetailKey && $this->CusomterOrderNo->FormValue != NULL && $this->CusomterOrderNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CusomterOrderNo->caption(), $this->CusomterOrderNo->RequiredErrorMessage));
			}
		}
		if ($this->IdType->Required) {
			if (!$this->IdType->IsDetailKey && $this->IdType->FormValue != NULL && $this->IdType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IdType->caption(), $this->IdType->RequiredErrorMessage));
			}
		}
		if ($this->ID_Contact->Required) {
			if (!$this->ID_Contact->IsDetailKey && $this->ID_Contact->FormValue != NULL && $this->ID_Contact->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Contact->caption(), $this->ID_Contact->RequiredErrorMessage));
			}
		}
		if ($this->CreateUser->Required) {
			if (!$this->CreateUser->IsDetailKey && $this->CreateUser->FormValue != NULL && $this->CreateUser->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CreateUser->caption(), $this->CreateUser->RequiredErrorMessage));
			}
		}
		if ($this->CreateDate->Required) {
			if (!$this->CreateDate->IsDetailKey && $this->CreateDate->FormValue != NULL && $this->CreateDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CreateDate->caption(), $this->CreateDate->RequiredErrorMessage));
			}
		}
		if ($this->StatusLoad->Required) {
			if (!$this->StatusLoad->IsDetailKey && $this->StatusLoad->FormValue != NULL && $this->StatusLoad->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->StatusLoad->caption(), $this->StatusLoad->RequiredErrorMessage));
			}
		}
		if ($this->StatusFinishOrder->Required) {
			if (!$this->StatusFinishOrder->IsDetailKey && $this->StatusFinishOrder->FormValue != NULL && $this->StatusFinishOrder->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->StatusFinishOrder->caption(), $this->StatusFinishOrder->RequiredErrorMessage));
			}
		}
		if ($this->DateTimefinishOrder->Required) {
			if (!$this->DateTimefinishOrder->IsDetailKey && $this->DateTimefinishOrder->FormValue != NULL && $this->DateTimefinishOrder->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateTimefinishOrder->caption(), $this->DateTimefinishOrder->RequiredErrorMessage));
			}
		}
		if ($this->UserFinishOrder->Required) {
			if (!$this->UserFinishOrder->IsDetailKey && $this->UserFinishOrder->FormValue != NULL && $this->UserFinishOrder->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UserFinishOrder->caption(), $this->UserFinishOrder->RequiredErrorMessage));
			}
		}
		if ($this->UpdateDate->Required) {
			if (!$this->UpdateDate->IsDetailKey && $this->UpdateDate->FormValue != NULL && $this->UpdateDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UpdateDate->caption(), $this->UpdateDate->RequiredErrorMessage));
			}
		}
		if ($this->UpdateUser->Required) {
			if (!$this->UpdateUser->IsDetailKey && $this->UpdateUser->FormValue != NULL && $this->UpdateUser->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UpdateUser->caption(), $this->UpdateUser->RequiredErrorMessage));
			}
		}
		if ($this->PrintSubLable->Required) {
			if (!$this->PrintSubLable->IsDetailKey && $this->PrintSubLable->FormValue != NULL && $this->PrintSubLable->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PrintSubLable->caption(), $this->PrintSubLable->RequiredErrorMessage));
			}
		}
		if ($this->Packing->Required) {
			if (!$this->Packing->IsDetailKey && $this->Packing->FormValue != NULL && $this->Packing->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Packing->caption(), $this->Packing->RequiredErrorMessage));
			}
		}
		if ($this->FinishPacking->Required) {
			if (!$this->FinishPacking->IsDetailKey && $this->FinishPacking->FormValue != NULL && $this->FinishPacking->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FinishPacking->caption(), $this->FinishPacking->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("tbl_orderguide", $detailTblVar) && $GLOBALS["tbl_orderguide"]->DetailEdit) {
			if (!isset($GLOBALS["tbl_orderguide_grid"]))
				$GLOBALS["tbl_orderguide_grid"] = new tbl_orderguide_grid(); // Get detail page object
			$GLOBALS["tbl_orderguide_grid"]->validateGridForm();
		}
		if (in_array("tbl_orderdetail", $detailTblVar) && $GLOBALS["tbl_orderdetail"]->DetailEdit) {
			if (!isset($GLOBALS["tbl_orderdetail_grid"]))
				$GLOBALS["tbl_orderdetail_grid"] = new tbl_orderdetail_grid(); // Get detail page object
			$GLOBALS["tbl_orderdetail_grid"]->validateGridForm();
		}
		if (in_array("vwhistoryPicking", $detailTblVar) && $GLOBALS["vwhistoryPicking"]->DetailEdit) {
			if (!isset($GLOBALS["vwhistoryPicking_grid"]))
				$GLOBALS["vwhistoryPicking_grid"] = new vwhistoryPicking_grid(); // Get detail page object
			$GLOBALS["vwhistoryPicking_grid"]->validateGridForm();
		}
		if (in_array("vwPackingdetail", $detailTblVar) && $GLOBALS["vwPackingdetail"]->DetailEdit) {
			if (!isset($GLOBALS["vwPackingdetail_grid"]))
				$GLOBALS["vwPackingdetail_grid"] = new vwPackingdetail_grid(); // Get detail page object
			$GLOBALS["vwPackingdetail_grid"]->validateGridForm();
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($filter);
		$conn = &$this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Begin transaction
			if ($this->getCurrentDetailTable() <> "")
				$conn->beginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// OrderDate
			$this->OrderDate->setDbValueDef($rsnew, UnFormatDateTime($this->OrderDate->CurrentValue, 7), NULL, $this->OrderDate->ReadOnly);

			// InvoiceNo
			$this->InvoiceNo->setDbValueDef($rsnew, $this->InvoiceNo->CurrentValue, NULL, $this->InvoiceNo->ReadOnly);

			// CusomterOrderNo
			$this->CusomterOrderNo->setDbValueDef($rsnew, $this->CusomterOrderNo->CurrentValue, NULL, $this->CusomterOrderNo->ReadOnly);

			// IdType
			$this->IdType->setDbValueDef($rsnew, $this->IdType->CurrentValue, NULL, $this->IdType->ReadOnly);

			// ID_Contact
			$this->ID_Contact->setDbValueDef($rsnew, $this->ID_Contact->CurrentValue, NULL, $this->ID_Contact->ReadOnly);

			// StatusLoad
			$this->StatusLoad->setDbValueDef($rsnew, $this->StatusLoad->CurrentValue, NULL, $this->StatusLoad->ReadOnly);

			// StatusFinishOrder
			$this->StatusFinishOrder->setDbValueDef($rsnew, $this->StatusFinishOrder->CurrentValue, NULL, $this->StatusFinishOrder->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);
			if ($updateRow) {
				$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($editRow) {
				}

				// Update detail records
				$detailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($editRow) {
					if (in_array("tbl_orderguide", $detailTblVar) && $GLOBALS["tbl_orderguide"]->DetailEdit) {
						if (!isset($GLOBALS["tbl_orderguide_grid"]))
							$GLOBALS["tbl_orderguide_grid"] = new tbl_orderguide_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "tbl_orderguide"); // Load user level of detail table
						$editRow = $GLOBALS["tbl_orderguide_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("tbl_orderdetail", $detailTblVar) && $GLOBALS["tbl_orderdetail"]->DetailEdit) {
						if (!isset($GLOBALS["tbl_orderdetail_grid"]))
							$GLOBALS["tbl_orderdetail_grid"] = new tbl_orderdetail_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "tbl_orderdetail"); // Load user level of detail table
						$editRow = $GLOBALS["tbl_orderdetail_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("vwhistoryPicking", $detailTblVar) && $GLOBALS["vwhistoryPicking"]->DetailEdit) {
						if (!isset($GLOBALS["vwhistoryPicking_grid"]))
							$GLOBALS["vwhistoryPicking_grid"] = new vwhistoryPicking_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "vwhistoryPicking"); // Load user level of detail table
						$editRow = $GLOBALS["vwhistoryPicking_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("vwPackingdetail", $detailTblVar) && $GLOBALS["vwPackingdetail"]->DetailEdit) {
						if (!isset($GLOBALS["vwPackingdetail_grid"]))
							$GLOBALS["vwPackingdetail_grid"] = new vwPackingdetail_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "vwPackingdetail"); // Load user level of detail table
						$editRow = $GLOBALS["vwPackingdetail_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() <> "") {
					if ($editRow) {
						$conn->commitTrans(); // Commit transaction
					} else {
						$conn->rollbackTrans(); // Rollback transaction
					}
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up detail parms based on QueryString
	protected function setupDetailParms()
	{

		// Get the keys for master table
		if (Get(TABLE_SHOW_DETAIL) !== NULL) {
			$detailTblVar = Get(TABLE_SHOW_DETAIL);
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar <> "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("tbl_orderguide", $detailTblVar)) {
				if (!isset($GLOBALS["tbl_orderguide_grid"]))
					$GLOBALS["tbl_orderguide_grid"] = new tbl_orderguide_grid();
				if ($GLOBALS["tbl_orderguide_grid"]->DetailEdit) {
					$GLOBALS["tbl_orderguide_grid"]->CurrentMode = "edit";
					$GLOBALS["tbl_orderguide_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["tbl_orderguide_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["tbl_orderguide_grid"]->setStartRecordNumber(1);
					$GLOBALS["tbl_orderguide_grid"]->ID_Order->IsDetailKey = TRUE;
					$GLOBALS["tbl_orderguide_grid"]->ID_Order->CurrentValue = $this->ID_Order->CurrentValue;
					$GLOBALS["tbl_orderguide_grid"]->ID_Order->setSessionValue($GLOBALS["tbl_orderguide_grid"]->ID_Order->CurrentValue);
				}
			}
			if (in_array("tbl_orderdetail", $detailTblVar)) {
				if (!isset($GLOBALS["tbl_orderdetail_grid"]))
					$GLOBALS["tbl_orderdetail_grid"] = new tbl_orderdetail_grid();
				if ($GLOBALS["tbl_orderdetail_grid"]->DetailEdit) {
					$GLOBALS["tbl_orderdetail_grid"]->CurrentMode = "edit";
					$GLOBALS["tbl_orderdetail_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["tbl_orderdetail_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["tbl_orderdetail_grid"]->setStartRecordNumber(1);
					$GLOBALS["tbl_orderdetail_grid"]->ID_Order->IsDetailKey = TRUE;
					$GLOBALS["tbl_orderdetail_grid"]->ID_Order->CurrentValue = $this->ID_Order->CurrentValue;
					$GLOBALS["tbl_orderdetail_grid"]->ID_Order->setSessionValue($GLOBALS["tbl_orderdetail_grid"]->ID_Order->CurrentValue);
				}
			}
			if (in_array("vwhistoryPicking", $detailTblVar)) {
				if (!isset($GLOBALS["vwhistoryPicking_grid"]))
					$GLOBALS["vwhistoryPicking_grid"] = new vwhistoryPicking_grid();
				if ($GLOBALS["vwhistoryPicking_grid"]->DetailEdit) {
					$GLOBALS["vwhistoryPicking_grid"]->CurrentMode = "edit";
					$GLOBALS["vwhistoryPicking_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["vwhistoryPicking_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["vwhistoryPicking_grid"]->setStartRecordNumber(1);
					$GLOBALS["vwhistoryPicking_grid"]->ID_Order->IsDetailKey = TRUE;
					$GLOBALS["vwhistoryPicking_grid"]->ID_Order->CurrentValue = $this->ID_Order->CurrentValue;
					$GLOBALS["vwhistoryPicking_grid"]->ID_Order->setSessionValue($GLOBALS["vwhistoryPicking_grid"]->ID_Order->CurrentValue);
				}
			}
			if (in_array("vwPackingdetail", $detailTblVar)) {
				if (!isset($GLOBALS["vwPackingdetail_grid"]))
					$GLOBALS["vwPackingdetail_grid"] = new vwPackingdetail_grid();
				if ($GLOBALS["vwPackingdetail_grid"]->DetailEdit) {
					$GLOBALS["vwPackingdetail_grid"]->CurrentMode = "edit";
					$GLOBALS["vwPackingdetail_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["vwPackingdetail_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["vwPackingdetail_grid"]->setStartRecordNumber(1);
					$GLOBALS["vwPackingdetail_grid"]->Id_order->IsDetailKey = TRUE;
					$GLOBALS["vwPackingdetail_grid"]->Id_order->CurrentValue = $this->ID_Order->CurrentValue;
					$GLOBALS["vwPackingdetail_grid"]->Id_order->setSessionValue($GLOBALS["vwPackingdetail_grid"]->Id_order->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tbl_orderlist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
	}

	// Set up detail pages
	protected function setupDetailPages()
	{
		$pages = new SubPages();
		$pages->Style = "tabs";
		$pages->add('tbl_orderguide');
		$pages->add('tbl_orderdetail');
		$pages->add('vwhistoryPicking');
		$pages->add('vwPackingdetail');
		$this->DetailPages = $pages;
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql <> "" && count($fld->Lookup->ParentFields) == 0 && count($fld->Lookup->Options) == 0) {
				$conn = &$this->getConnection();
				$totalCnt = $this->getRecordCount($sql);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_IdType":
							break;
						case "x_ID_Contact":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>