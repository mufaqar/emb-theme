function companyProfile() {
  var companyProfile = document.querySelector('.companyProfile');
  var myProfile = document.querySelector('.myprofile');
  var myProfileNav = document.querySelector('.myProfileNav');
  var companyProfileNav = document.querySelector('.companyProfileNav');
  companyProfile.classList.add('active');
  myProfile.classList.remove('active');
  companyProfileNav.classList.add('activeNav');
  myProfileNav.classList.remove('activeNav');
}

function myProfile() {
  var companyProfile = document.querySelector('.companyProfile');
  var myProfile = document.querySelector('.myprofile');
  var companyProfileNav = document.querySelector('.companyProfileNav');
  var myProfileNav = document.querySelector('.myProfileNav');
  companyProfile.classList.remove('active');
  myProfile.classList.add('active');
  companyProfileNav.classList.remove('activeNav');
  myProfileNav.classList.add('activeNav');
}

$(document).ready(function () {
  $('.myProfileNav li').click(function () {
    $('li').removeClass('active');
    $(this).addClass('active');
  });
});

$(document).ready(function () {
  $('.companyProfileNav li').click(function () {
    $('li').removeClass('active');
    $(this).addClass('active');
  });
});

// tabs
(function () {
  $(function () {
    var toggle;
    return (toggle = new Toggle('.toggle'));
  });

  this.Toggle = (function () {
    Toggle.prototype.el = null;

    Toggle.prototype.tabs = null;

    Toggle.prototype.panels = null;

    function Toggle(toggleClass) {
      this.el = $(toggleClass);
      this.tabs = this.el.find('.tab');
      this.panels = this.el.find('.panel');
      this.bind();
    }

    Toggle.prototype.show = function (index) {
      var activePanel, activeTab;
      this.tabs.removeClass('active');
      activeTab = this.tabs.get(index);
      $(activeTab).addClass('active');
      this.panels.hide();
      activePanel = this.panels.get(index);
      return $(activePanel).show();
    };

    Toggle.prototype.bind = function () {
      var _this = this;
      return this.tabs.unbind('click').bind('click', function (e) {
        return _this.show($(e.currentTarget).index());
      });
    };

    return Toggle;
  })();
}.call(this));

// product counter
// var count = 0;
// $('i.count-up').click(function () {
//   if (count == 0) {
//     count++;
//     $(this).prev().val(count);
//   } else if (count != 0) {
//     count = $(this).prev().val();
//     count++;
//     $(this).prev().val(count);
//   }
// });
// $('i.count-down').click(function () {
//   var count = $(this).next().val();
//   if (count >= '1') {
//     count--;
//     $(this).next().val(count);
//   } else {
//     return false;
//   }
// });

// increment value in product
var countNumber = 0;
function handleCountInc(pid) {
  const element = document.querySelector(`[data-id='${pid}']`);
  countNumber = element.value;
  if (countNumber >= 0) {
    countNumber++;
    element.value = countNumber;
  } else {
    countNumber++;
    element.value = countNumber;
  }
}
// Decrement value in product
function handleCountDec(pid) {
  const element = document.querySelector(`[data-id='${pid}']`);
  countNumber = element.value;
  if (countNumber == 0) {
    countNumber = 0;
    element.value = countNumber;
  } else {
    countNumber--;
    element.value = countNumber;
  }
}

function showCounter(data) {
  var btn = document.querySelector('.id'.concat(data));
  var counter = document.querySelector('.cid'.concat(data));
  btn.style.display = 'none';
  counter.classList.add('show');
}

function hamburger() {
  var SideMenu = document.querySelector('.sidebar');
  SideMenu.style.display = 'block';
}

function HideNav() {
  var SideMenu = document.querySelector('.sidebar');
  SideMenu.style.display = 'none';
}

function stepOne() {
  var stepOne = document.querySelector('.step_one');
  var stepTwo = document.querySelector('.step_two');
  var FirstStep = document.querySelector('.first_step');
  var SecoundStep = document.querySelector('.secound_step');
  stepOne.style.background = '#D9D9D9';
  stepTwo.style.background = '#5FB227';
  FirstStep.classList.add('stephide');
  FirstStep.classList.remove('stepshow');
  SecoundStep.classList.add('stepshow'); //show
}
function stepTwo() {
  var stepTwo = document.querySelector('.step_two');
  var stepThree = document.querySelector('.step_three');
  var SecoundStep = document.querySelector('.secound_step');
  var ThirdStep = document.querySelector('.third_step');
  stepThree.style.background = '#5FB227';
  stepTwo.style.background = '#D9D9D9';
  SecoundStep.classList.remove('stepshow');
  ThirdStep.classList.add('stepshow');
}
function stepLast() {
  var Steps = document.querySelector('.agreement_steps');
  var Final = document.querySelector('.finish_step');
  var ThirdStep = document.querySelector('.third_step');
  ThirdStep.classList.remove('stepshow');
  Steps.classList.add('stephide');
  Final.classList.add('stepshow');
}

function backToStepOne() {
  var stepOne = document.querySelector('.step_one');
  var stepTwo = document.querySelector('.step_two');
  var FirstStep = document.querySelector('.first_step');
  var SecoundStep = document.querySelector('.secound_step');
  stepOne.style.background = '#5FB227';
  stepTwo.style.background = '#D9D9D9';
  FirstStep.classList.add('stepshow');
  SecoundStep.classList.remove('stepshow');
}
function backToStepTwo() {
  var stepTwo = document.querySelector('.step_two');
  var stepThree = document.querySelector('.step_three');
  var SecoundStep = document.querySelector('.secound_step');
  var ThirdStep = document.querySelector('.third_step');
  stepTwo.style.background = '#5FB227';
  stepThree.style.background = '#D9D9D9';
  SecoundStep.classList.add('stepshow');
  ThirdStep.classList.remove('stepshow');
}

function showOrderCounter(id) {
  var btn = document.querySelector('._id'.concat(id));
  var counterWrapper = document.querySelector('._cid'.concat(id));
  btn.style.display = 'none';
  counterWrapper.classList.add('show');
}

function activeEmp() {
  var activebtn = document.querySelector('.activeEmp');
  var inactivebtn = document.querySelector('.inactiveEmp');
  var activeContent = document.querySelector('.activeEmp_content');
  var inActiveContent = document.querySelector('.inactiveEmp_content');
  activebtn.classList.add('active');
  inactivebtn.classList.remove('active');
  activeContent.classList.add('active');
  inActiveContent.classList.remove('active');
}
function inactiveEmp() {
  var activebtn = document.querySelector('.activeEmp');
  var inactivebtn = document.querySelector('.inactiveEmp');
  var activeContent = document.querySelector('.activeEmp_content');
  var inActiveContent = document.querySelector('.inactiveEmp_content');
  activebtn.classList.remove('active');
  inactivebtn.classList.add('active');
  activeContent.classList.remove('active');
  inActiveContent.classList.add('active');
}

// my Profile script section

function lastStep() {
  var myProfile_reg = document.querySelector('.first_step');
  var myProfile_msg = document.querySelector('.finish_step');
  console.log(myProfile_reg);
  myProfile_reg.classList.add('_hide');
  myProfile_msg.classList.add('_show');
}

//convertToWeekPicker($('#weekPicker2'));
