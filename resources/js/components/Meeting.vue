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
        isActive: true,
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

                    this.isActive = false;
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
            this.isActive = this.isActive === false;
            this.isActive = this.isActive === false;
            this.isCollapsed = this.isCollapsed === false;

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
                this.agendaParentRef[agendaParentRef] = true;

                this.agendaList.forEach(agenda => {

                    let agendaMainNumber = agenda.number.split('.', 1)[0];
                    console.log(agenda.number, agendaMainNumber, Math.floor(agenda.number));

                    if (agenda.number && agenda.number.includes('.')
                        && agendaChildNumber === agendaMainNumber) {
                        this.agendaChildRef[agenda.id] = true;
                    }
                });

                agendaHead.scrollIntoView({ behavior: 'smooth'});
            }
        },
        backToList() {
            this.collapseAgendaChild(this.agendaChild, this.agendaType);
            // clear selected items for the new back button instance
            this.agendaChildNumber = '';
            this.agendaType = '';
            this.backButtonPublic = false;
            this.backButtonPrivate = false;
            this.isCollapsed = false;
            this.isActive = true;
        }
    },
};
</script>
