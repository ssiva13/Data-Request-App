INSERT INTO data_request_app.data_look_up (`type`,value,name,status) VALUES
	 ('lookup','lookup','Question Options',1),
	 ('lookup','data_type','Data Type Options',1),
	 ('lookup','proposal_type','Proposal Type Options',1),
	 ('lookup','yesno','Yes or No Options',1),
	 ('lookup','affiliation','Affiliation Options',1),
	 ('lookup','request_status','Data Request Status Options',1),
	 ('proposal_type','draft','Draft Proposal',1),
	 ('yesno','yes','Yes',1),
	 ('yesno','no','No',1),
	 ('affiliation','data_manager','Data Manager',1);
INSERT INTO data_request_app.data_look_up (`type`,value,name,status) VALUES
	 ('data_type','samples','Lab Samples',1),
	 ('request_status','1','Under Review',1),
	 ('request_status','2','Resubmit',1),
	 ('request_status','3','Pending Approval',1),
	 ('request_status','4','Approved',1),
	 ('request_status','5','Declined',1),
	 ('lookup','role','Role Options',1),
	 ('role','dev','Developer',1);