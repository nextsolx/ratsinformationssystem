<script>
import sortingMixin from '../mixins/sortingMixin';

export default {
    name: 'Meeting',
    mixins: [sortingMixin],
    data: () => ({
        activeTab: 'true',
        dropValue: 'Funktion',
        agendaListSorted: [],
        inputValueAgenda: '',
        isActiveChild: false,
        agendaParentRef: [],
        agendaChildRef: [],
    }),
    props: {
        agendaList: {
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
        searchAgenda(inputValue) {
            this.inputValueAgenda = inputValue;
            this.agendaListSorted = [];

            if (inputValue) {
                if (inputValue.length > 1) {
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
        collapseAgendaChild(agendaChildNumber, agendaType, parentAgenda) {
            if (!this.agendaParentRef[parentAgenda]) {
                this.$set(this.agendaParentRef, parentAgenda, true);

                this.agendaList.forEach(agenda => {
                    let agendaMainNumber = agenda.number.split('.', 1)[0];
                    if (agenda.number && agenda.number.includes('.') && agendaChildNumber === +agendaMainNumber) {
                        this.$set(this.agendaChildRef, agenda.id, true);
                    }
                });
            } else {
                this.agendaParentRef[parentAgenda] = false;

                this.agendaList.forEach(agenda => {
                    let agendaMainNumber = agenda.number.split('.', 1)[0];
                    if (agenda.number && agenda.number.includes('.') && agendaChildNumber === +agendaMainNumber) {
                        this.agendaChildRef[agenda.id] = false;
                    }
                });
            }

            this.$refs[parentAgenda].scrollIntoView({ behavior: 'smooth'});
        },
    },
};
</script>
