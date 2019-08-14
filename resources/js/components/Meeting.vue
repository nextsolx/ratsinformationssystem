<script>
export default {
    name: 'Meeting',
    data: () => ({
        activeTab: 'true',
        dropValue: 'Funktion',
    }),
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
    },
};
</script>
