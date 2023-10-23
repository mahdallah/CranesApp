using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Web;

namespace HijazCranes.Models
{
    public class Account
    {
        public int Id { get; set; }


        [Display(Name = "Bank")]
        public string Name { get; set; }


        [Display(Name = "Account Number")]
        public string AccountNo { get; set; }

        public double Amount { get; set; }

        [DataType(DataType.Date)]
        [DisplayFormat(DataFormatString = "{0:ddd, dd MMM yyyy hh:mm tt}", ApplyFormatInEditMode = true)]
        public DateTime Created { get; set; } = DateTime.Now;
    }
}