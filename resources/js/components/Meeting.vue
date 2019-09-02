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
        isActive: true,
        isActiveChild: false,
        isCollapsed: false,
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

                    //this.isActive = false;

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
        collapseAgendaChild(agendaChildNumber, agendaType) {
            this.agendaChildNumber = agendaChildNumber;
            this.agendaType = agendaType;
            //this.isActive = !this.isActive;
            this.isCollapsed = this.isCollapsed === false;

            const agendaHead = document.querySelector(`._agenda-head-${agendaType}-${agendaChildNumber}`);

            if (agendaHead) {
                if (this.isCollapsed) {
                    console.log('Open child: ', agendaChildNumber);

                    this.agendaList.forEach(agenda => {
                        let agendaMainNumber = agenda.number.split('.', 1)[0];
                        console.log('Main number: ', agendaMainNumber);

                        if (agenda.number && agenda.number.includes('.') && agendaChildNumber === +agendaMainNumber) {

                            this.agendaChildRef[agenda.id] = true;

                            console.log('Activation: ', agenda.id, true);
                        }
                    });
                } else {
                    this.agendaChildRef = [];
                }

                agendaHead.scrollIntoView({ behavior: 'smooth'});

                console.log('Child: ', this.agendaChildRef);
            }
        },
    },
};
</script>
