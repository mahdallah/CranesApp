using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Web;

namespace HijazCranes.Models
{
    public class Receipt 
    {
        public int Id { get; set; }
        [Display(Name = "Paying")]
        public double Paid { get; set; }
        public double Remained { get; set; }
        public int Quote_Id { get; set; }
        public int Customer_Id { get; set; }
        public int Account_Id { get; set; }


        [DisplayFormat(DataFormatString = "{0:ddd, dd MMM yyyy hh:mm tt}", ApplyFormatInEditMode = true)]
        [DataType(DataType.Date)]
        public DateTime Created { get; set; } = DateTime.Now;


        [ForeignKey("Account_Id")]
        public Account Account { get; set; }


        [ForeignKey("Customer_Id")]
        public Customer Customer { get; set; }


        [ForeignKey("Quote_Id")]
        public Quote Quote { get; set; }
    }
}