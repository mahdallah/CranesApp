using HijazCranes.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace HijazCranes.ViewModels
{
    public class SaveCustomerViewModel
    {
        public Customer Customer { get; set; }
        public List<CustomerContact> Contacts { get; set; }
    }
}