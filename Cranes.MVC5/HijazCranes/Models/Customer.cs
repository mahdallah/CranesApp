using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace HijazCranes.Models
{
    public class Customer 
    {
        public int Id { get; set; }
        [DisplayName("First Name")]
        public string FirstName { get; set; }
        [DisplayName("Last Name")]
        public string LastName { get; set; }


        [DataType(DataType.Date)]
        [DisplayFormat(DataFormatString = "{0:ddd, dd MMM yyyy hh:mm tt}", ApplyFormatInEditMode = true)]
        public DateTime Created { get; set; } = DateTime.Now;


        [NotMapped]
        public string FullName => $"{FirstName} {LastName}";


        public virtual List<CustomerContact> CustomerContacts { get; set; }
    }
}