<template>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card">
        <div class="card-header">GrowFood Форма заказа</div>

        <div class="card-body">

          <form>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Телефон</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="+79516682774" v-model="phone">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Имя</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Ваше имя" v-model="name">
              </div>
            </div>


            <div class="form-group row">
              <label class="col-sm-12 col-form-label">Выберите тариф</label>

              <div class="col-sm-12">

                <div class="list-group">
                  <a 
                    href="#" 
                    :class="getTariffClasses(tariff.id)"
                    v-for="tariff in tariffs"
                    @click="selectTariff(tariff)"
                  >
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">{{tariff.name}}</h5>
                      <small>$ {{tariff.price}}</small>
                    </div>
                  </a>
                </div>

              </div>
            </div>

            <div 
              class="form-group row"
              v-if="selectedTariff"
            >
              <label for="inputPassword" class="col-sm-12 col-form-label">Выберите первый день доставки</label>
              <div class="col-sm-12">

                <ul class="list-group list-group-horizontal text-center js-days-list">
                  <label 
                    class="list-group-item list-group-item-action"
                    v-for="day in daysOfWeek"
                  >
                    <div :class="dayOfWeekIsAllowed(daysOfWeek.indexOf(day)) ? '' : 'disabled'">
                      <input 
                        type="radio"
                        name="day"
                        v-model="firstDay"
                        :value="daysOfWeek.indexOf(day) + 1" 
                        :disabled="dayOfWeekIsAllowed(daysOfWeek.indexOf(day)) ? false : true"
                      >
                      <br>
                      {{day}}
                    </div>
                  </label>
                </ul>

              </div>
            </div>

            <button 
              type="submit" 
              class="btn btn-primary" 
              @click.prevent="send()"
              :disabled="!isSendAvailable()"
            >Заказать</button>

          </form>

        </div>
      </div>

    </div>
  </div>
</div>
</template>

<script>
  export default {
    data() {
      return {
        'name': null,
        'phone': null,
        'tariffs': [],
        'selectedTariff': null,
        'daysOfWeek': [
          'Пон',
          'Вт',
          'Ср',
          'Чт',
          'Пт',
          'Суб',
          'Вс',
        ],
        'firstDay': null,
      }
    },
    mounted() {
      this.tariffs = fetch('/get-tariffs', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          'Content-Type': 'application/json;charset=utf-8'
        }
      })
        .then(data => {return data.json()})
        .then(data => {this.tariffs = data});
    },
    methods: {
      getTariffClasses(tariffId) {
        return {
          'list-group-item': true,
          'list-group-item-action': true,
          'active': (this.selectedTariff && this.selectedTariff.id === tariffId) ? true : false,
        }
      },
      dayOfWeekIsAllowed(dayNumber) {
        return this.selectedTariff.days.substr(dayNumber,1) === '1';
      },
      selectTariff(tariff) {
        if (this.selectedTariff && this.selectedTariff.id === tariff.id) {
          return;
        }

        // При выборе тарифа нужно сбросить выбраный день недели
        document.querySelectorAll("ul.js-days-list input").forEach((btn)=> {
          btn.checked = false;
        })

        this.firstDay = null

        this.selectedTariff = tariff
      },
      isSendAvailable() {
        return this.name 
          && this.phone
          && this.selectedTariff
          && this.firstDay;
      },
      send() {
        fetch('/order', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/json;charset=utf-8'
          },
          body: JSON.stringify({
            name: this.name,
            phone: this.phone,
            tariff: this.selectedTariff.id,
            firstDay: this.firstDay,
          }),
        })
          .then(data => {return data.json()})
          .then(data => {console.log(data)});

        return false
      },
    },
  }
</script>


<style scoped>
  .list-group-item-action {
    cursor: pointer;
  }

  .list-group-item-action > .disabled {
    opacity: .2;
  }
</style>