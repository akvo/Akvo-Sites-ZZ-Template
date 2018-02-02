var logframeConfig = {
	gridHeight: 24
};

var logFrameData = {
	"Activities": {
		className: "activities",
		cellNum: 2,
		cellData: {
			1: {
				height: 12,
			},
			2: {
				height: 12,
			}
		}
	},
	"Outputs": {
		className: "outputs",
		cellNum: 18,
		cellData: {
			1: {
				name: "Number of media campaigns",
				height: 1,
				cellNumber: 21,
				cellGlyph: false,
				icon: "arrowGraph",
				iconLeft: false,
				next: 1
			},
			2: {
				name: "Number of awareness campaigns",
				height: 1,
				cellNumber: 20,
				cellGlyph: false,
				icon: "arrowGraph",
				iconLeft: false,
				next: 1
			},
			3: {
				name: "Drinking water sources",
				height: 1,
				cellNumber: 19,
				cellGlyph: false,
				icon: "arrowGraph",
				iconLeft: false,
				next: 1
			},
			4: {
				name: "Sanitation service at public places",
				height: 1,
				cellNumber: 18,
				cellGlyph: false,
				icon: "arrowGraph",
				iconLeft: false,
				next: 1
			},
			5: {
				name: "Small producers, business & service providers",
				height: 1,
				cellNumber: 5,
				cellGlyph: "money",
				icon: "book",
				iconLeft: false,
				next: 2
			},
			6: {
				name: "Credit pilots by local finance institutions",
				height: 1,
				cellNumber: 7,
				cellGlyph: "money",
				icon: "",
				iconLeft: false,
				next: 3
			},
			7: {
				name: "Lobby for increased WASH financing",
				height: 1,
				cellNumber: 9,
				cellGlyph: "money",
				icon: "",
				iconLeft: false,
				next: 4
			},
			8: {
				name: "On budget tracking, include who is trained",
				height: 1,
				cellNumber: 10,
				cellGlyph: "money",
				icon: "book",
				iconLeft: false,
				next: 4
			},
			9: {
				name: "Active stakeholders coordination structures exist",
				height: 1,
				cellNumber: 12,
				cellGlyph: "hands",
				icon: "",
				iconLeft: false,
				next: 5
			},
			10: {
				name: "Local government departments",
				height: 1,
				cellNumber: 14,
				cellGlyph: "hands",
				icon: "book",
				iconLeft: false,
				next: 6,
			},
			11: {
				name: "BLANK",
				height: 1
			},		
			12: {
				name: "Local governments on RTWS",
				height: 1,
				cellNumber: 17,
				cellGlyph: "parent",
				icon: "book",
				iconLeft: false,
				next: 8
			},
			13: {
				name: "CG's on safe use of waste, waste water, & excreta for productive purposes",
				height: 2,
				cellNumber: 30,
				cellGlyph: "money",
				icon: "book",
				iconLeft: true,
				next: 9
			},
			14: {
				name: "CPP's on E-sustainability approaches for WASH",
				height: 2,
				cellNumber: 32,
				cellGlyph: "tree",
				icon: "book",
				iconLeft: true,
				next: 10
			},
			15: {
				name: "CG's with recognisable voice/representation of women & marginalized groups",
				height: 2,
				cellNumber: 25,
				cellGlyph: "parent",
				icon: "",
				iconLeft: false,
				next: 11
			},
			16: {
				name: "CSOs & private sector on RTWS",
				height: 2,
				cellNumber: 26,
				cellGlyph: "parent",
				icon: "book",
				iconLeft: true,
				next: 11
			},
			17: {
				name: "CPP's to use the Sustainability Monitoring Framework",
				height: 2,
				cellNumber: 28,
				cellGlyph: false,
				icon: "book",
				iconLeft: true,
				next: 12
			},
			18: {
				name: "CPP's based on their organisational capacity assessment",
				height: 2,
				cellNumber: 33,
				cellGlyph: false,
				icon: "book",
				iconLeft: true,
				next: 13
			}
		}
	},
	"SPACER": {
		className: "spacer",
		cellNum: 4,
		cellData: {
			1: {
				name: "BLANK",
				height: 2
			},
			2: {
				name: "ARROW",
				height: 10
			},
			3: {
				name: "ARROW",
				height: 10
			},
			4: {
				name: "BLANK",
				height: 2
			}
		}
	},
	"Intermediary outcomes": {
		className: "intermediary-outcomes",
		cellNum: 13,
		cellData: {	
			1: {
				name: "BLANK",
				height: 4
			},
			2: {
				name: "Role of the private sector",
				height: 1,
				cellNumber: 4,
				cellGlyph: "money",
				icon: "arrowGraph",
				iconLeft: true,
				next: 1
			},
			3: {
				name: "Local finance possibilities for WASH activities",
				height: 1,
				cellNumber: 6,
				cellGlyph: "money",
				icon: "arrowGraph",
				iconLeft: true
			},
			4: {
				name: "Local public WASH budget",
				height: 2,
				cellNumber: 8,
				cellGlyph: "money",
				icon: "arrowGraph",
				iconLeft: true
			},
			5: {
				name: "Coordination between WASH stakeholders",
				height: 1,
				cellNumber: 11,
				cellGlyph: "hands",
				icon: "arrowGraph",
				iconLeft: true
			},
			6: {
				name: "Public sector fulfils a leading & coordinative role",
				height: 1,
				cellNumber: 13,
				cellGlyph: "hands"
			},
			7: {
				name: "Locally accepted solutions & appropriate technology used",
				height: 1,
				cellNumber: 15,
				cellGlyph: "spanner"
			},
			8: {
				name: "Awareness within the government on RTWS",
				height: 1,
				cellNumber: 16,
				cellGlyph: "parent",
				icon: "arrowGraph",
				iconLeft: true
			},
			9: {
				name: "CG's are able to assist communities in improving their economic situation",
				height: 2,
				cellNumber: 29,
				cellGlyph: "money"
			},
			10: {
				name: "CPP's adopted the key elements of E-sustainability",
				height: 2,
				cellNumber: 31,
				cellGlyph: "tree"
			},
			11: {
				name: "CG's are successfully influencing policies, budgets, & designs",
				height: 4,
				cellNumber: 24,
				cellGlyph: "parent"
			},
			12: {
				name: "CPP's are able to monitor the sustainability of WASH services & facilities",
				height: 2,
				cellNumber: 27
			},
			13: {
				name: "BLANK",
				height: 2
			}
		}
	},
	"Outcomes": {
		className: "outcomes",
		cellNum: 8,
		hideBorders: true,
		cellData: {		
			1: {
				name: "BLANK",
				height: 6
			},
			2: {
				name: "Sanitation services",
				height: 2,
				cellNumber: 1,
				icon: "arrowGraph"
			},
			3: {
				name: "Safe (drinking) water",
				height: 2,
				cellNumber: 2,
				icon: "arrowGraph"
			},
			4: {
				name: "Hygiene & sanitation practises",
				height: 2,
				cellNumber: 3,
				icon: "arrowGraph"
			},
			5: {
				name: "BLANK",
				height: 1
			},
			6: {
				name: "CG's are able to implement, learn & carry out lobby/advocacy activities",
				height: 3,
				cellNumber: 22
			},
			7: {
				name: "CPP's are effectively supporting communities on access to WASH",
				height: 3,
				cellNumber: 23
			},
			8: {
				name: "BLANK",
				height: 5
			}
		}	
	},
	"Objectives": {
		className: "objectives",
		cellNum: 4,
		hideBorders: true,
		cellData: {	
			1: {
				name: "BLANK",
				height: 8
			},
			2: {
				name: "Access to & use of WASH services",
				height: 4
			},
			3: {
				name: "Empowered civil society actors",
				height: 4
			},
			4: {
				name: "BLANK",
				height: 8
			}
		}
	},		
	"Main objective": {
		className: "main-objective",
		cellNum: 1,
		hideBorders: true,
		cellData: {
			1: {
				name: "Sustainable WASH for all",
				height: 24
			}	
		}
	}		
};


