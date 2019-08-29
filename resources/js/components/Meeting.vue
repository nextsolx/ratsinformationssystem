<script>
export default {
    name: 'Meeting',
    data: () => ({
        activeTab: 'true',
        dropValue: 'Funktion',
        agendaChildNumber: '',
        agendaType: '',
        agendaListSorted: [],
        inputValue: '',
        backButtonPublic: false,
        backButtonPrivate: false,
        isActiveParent: true,
        isActiveChild: false,
        isActiveEmpty: true,
        isCollapsed: false,
        agendaParentRef: [],
        agendaChildRef: [],
    }),
    props: {
        agendaList: {
            type: Array,
            default: () => []
        },
        peopleList: {
            type: Array,
            default: () => []
        },
    },
    methods: {
        openTab(e, dataType) {
            const tabCurrent = e.currentTarget;
            const tabAll = document.querySelectorAll('.ris-tab');
            tabAll.forEach(tab => {
                tab.classList.remove('ris-tab_active');
            });
            tabCurrent.classList.add('ris-tab_active');

            this.displayTabData(dataType);
        },
        displayTabData(dataTypeRef) {
            const tabDataAll = document.querySelectorAll('.ris-tab-data');
            tabDataAll.forEach(tab => {
                tab.classList.remove('ris-tab-data_active');
            });
            this.$refs[dataTypeRef].classList.add('ris-tab-data_active');
        },
        orderMembersBy(orderBy) {
            // @todo --- need to add JS order functionality
            // console.log('Order By: ', orderBy);
            this.dropValue = orderBy;

            //this.sortBy(this.memberList, orderBy);
        },
        searchMember(inputValue) {
            console.log(inputValue);
        },
        searchAgenda(inputValue) {
            this.inputValue = inputValue;
            this.agendaListSorted = [];

            if (inputValue) {
                if (inputValue.length > 1) {
                    // clear collapsed child items for mobile version
                    this.agendaChildNumber = '';
                    this.agendaType = '';

                    this.isActiveParent = false;
                    this.isActiveChild = false;
                    // plus clear active 'back' button to all list
                    // const buttonBackList = document.querySelectorAll('.ris-button__back');
                    // buttonBackList.forEach(buttonBack => {
                    //     buttonBack.classList.remove('ris-button__back_active');
                    // });

                    let agendaTmpList = [],
                        agendaParentId = null;

                    this.agendaList.forEach(agenda => {
                        const agendaSearchText = agenda.resolutionText ? agenda.resolutionText.toLowerCase() : '',
                            agendaSearchName = agenda.name ? agenda.name.toLowerCase() : '';

                        if (agenda.number && !agenda.number.includes('.')) {
                            agendaParentId = agenda.id;

                            if (agendaSearchText.includes(inputValue.toLowerCase())
                                || agendaSearchName.includes(inputValue.toLowerCase())) {
                                agendaTmpList[agenda.id] = true;
                            }
                        } else {
                            if (agendaSearchText.includes(inputValue.toLowerCase())
                                || agendaSearchName.includes(inputValue.toLowerCase())) {
                                agendaTmpList[agenda.id] = true;
                                agendaTmpList[agendaParentId] = true;
                            }
                        }
                    });

                    this.agendaListSorted = agendaTmpList;
                }
            }
        },
        collapseAgendaChild(agendaChildNumber, agendaType, agendaParentRef) {
            this.agendaChildNumber = agendaChildNumber;
            this.agendaType = agendaType;
            this.agendaParentRef = [];
            this.backButtonPublic = false;
            this.backButtonPrivate = false;
            this.isActiveParent = this.isActiveParent === false;
            //this.isActiveChild = this.isActiveChild === false;
            this.isCollapsed = this.isCollapsed === false;

            console.log('Cleared Child: ', this.isActiveParent, this.agendaChildRef, this.agendaChildRef.length);

            const agendaChildList = document.querySelectorAll(`._agenda-child-${agendaType}-${agendaChildNumber}`),
                agendaHead = document.querySelector(`._agenda-head-${agendaType}-${agendaChildNumber}`),
                agendaListItem = document.querySelectorAll('.ris-agenda-list__item'),
                agendaList = document.querySelectorAll('.ris-agenda-list');

            if (agendaChildList && agendaHead) {
                // hide all agenda list(if 2 or more)
                /*agendaList.forEach(agenda => {
                    agenda.classList.toggle('ris-agenda-list_hidden');
                });*/

                //const agendaHeadParent = agendaHead.parentElement;
                // show only list block where chosen items
                // agendaHeadParent.classList.toggle('ris-agenda-list_hidden');
                // agendaHeadParent.classList.toggle('ris-agenda-list_active');

                // 'back' button for all list
                if (this.isCollapsed) {
                    if (agendaType === 1) {
                        this.backButtonPublic = true;
                    } else {
                        this.backButtonPrivate = true;
                    }
                }

                // hide all items
                // agendaListItem.forEach(agenda => {
                //     agenda.classList.toggle('ris-agenda-list__item_hidden-mobile');
                // });

                // show only chosen items - head
                //agendaHead.classList.toggle('ris-agenda-list__agenda-head_active');

                // show only chosen items - his children
                /*agendaChildList.forEach(agenda => {
                    agenda.classList.toggle('ris-agenda-list__agenda-child_active');
                });*/

                this.checkMobile(agendaParentRef);

                if (this.isActiveParent) {
                    this.agendaList.forEach(agenda => {

                        let agendaMainNumber = agenda.number.split('.', 1)[0];
                        console.log(agendaChildNumber, +agendaMainNumber);

                        if (agenda.number && agenda.number.includes('.')
                            && agendaChildNumber === +agendaMainNumber) {

                            console.log('Add child: ', agenda.id, agendaChildNumber, agendaMainNumber);
                            this.agendaChildRef[agenda.id] = true;
                        }
                    });
                } else {
                    this.agendaChildRef = [];
                }

                agendaHead.scrollIntoView({ behavior: 'smooth'});

                console.log(this.agendaParentRef, this.agendaChildRef);
            }
        },
        backToList() {
            this.collapseAgendaChild(this.agendaChildNumber, this.agendaType);
            // clear selected items for the new back button instance
            this.agendaChildNumber = '';
            this.agendaType = '';
            this.backButtonPublic = false;
            this.backButtonPrivate = false;
            this.isCollapsed = false;
            this.isActiveParent = true;
            this.isActiveChild = false;
        },
        checkMobile(agendaParentRef) {
            const bodyTag = document.querySelector('body');
            if (agendaParentRef && bodyTag.offsetWidth < 768) {
                // mobile version, set active only one parent items
                this.agendaParentRef[agendaParentRef] = true;
            } else {
                // desktop version, set active all parent items
                this.agendaList.forEach(agenda => {
                    if (agenda.number && !agenda.number.includes('.')) {
                        this.agendaParentRef[agenda.id] = true;
                    }
                });
            }
        }
    },
    mounted() {
        // collapse roof details on the desktop version
        this.checkMobile();

        window.addEventListener('resize', this.checkMobile);
    },

    beforeDestroy() {
        window.removeEventListener('resize', this.checkMobile);
    },
};
</script>
